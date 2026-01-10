<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class KycController extends Controller
{
    use FileUploadTrait;

    public function index(): View | RedirectResponse
    {
        if(auth('web')->user()->kyc?->status == 'approved' || auth('web')->user()->kyc?->status == 'pending') {
            return redirect()->route('vendor.dashboard');
        }

        return view('frontend.pages.kyc');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate fields
        $request->validate([
            'full_name' => ['required', 'max:255', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'max:255', 'string'],
            'full_address' => ['required', 'max:255', 'string'],
            'document_type' => ['required', 'max:255', 'string'],
            'document_scan_copy' => ['required', 'mimes:png,pdf,csv,docx', 'max:10000']
        ]);

        if (Kyc::where('user_id', auth('web')->user()->id)->exists()) {
            // Update if one already exists
            $kyc = Kyc::where('user_id', auth('web')->user()->id)->first();
        } else {
            // Create new instance
            $kyc = new Kyc();
        }

        // Create/udpate
        $kyc->full_name = $request->full_name;
        $kyc->status = 'pending';
        $kyc->user_id = auth('web')->user()->id;
        $kyc->date_of_birth = $request->date_of_birth;
        $kyc->gender = $request->gender;
        $kyc->full_address = $request->full_address;
        $kyc->document_type = $request->document_type;
        $filePath = $this->uploadPrivateFile($request->file('document_scan_copy'));
        $kyc->document_scan_copy = $filePath;

        $kyc->save();

        AlertService::created('Your KYC has been submitted successfully! Please wait for admin approval.');

        return redirect()->route('vendor.dashboard');
    }
}
