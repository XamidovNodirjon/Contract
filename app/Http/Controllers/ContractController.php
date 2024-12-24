<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    public function index(){
        $contracts = Contract::all();
        return view('contract.index',compact('contracts'));
    }

    public function create()
    {
        return view('contracts.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:individual,legal',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'passport_number' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'additional_info' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'inn' => 'nullable|string|max:255',
            'director_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'e_signature' => 'nullable|file|mimes:jpg,png,pdf',
        ]);

        if ($request->hasFile('e_signature')) {
            $validated['e_signature'] = $request->file('e_signature')->store('signatures');
        }

        $contract = Contract::create($validated);

        return redirect()->route('contract.show', $contract->id)->with('success', 'Shartnoma muvaffaqiyatli saqlandi.');
    }


    public function show($id)
    {
        $contract = Contract::find($id); // Modelingiz `Contract` deb nomlangan bo'lishi kerak.

        if (!$contract) {
            return redirect()->route('contract.index')->with('error', 'Shartnoma topilmadi.');
        }

        return view('contract.show', compact('contract'));
    }


    public function download(Contract $contract)
    {
        return response()->download(storage_path('app/public/' . $contract->contract_file_path));
    }

    public function confirm(Contract $contract)
    {
        $contract->update(['is_confirmed' => true]);

        return back()->with('success', 'Shartnoma tasdiqlandi.');
    }

//    public function generatePdf(Request $request)
//    {
//
//       // Collect input data
//        dd($request->all());
//    $data = [
//        'first_name' => $request->input('first_name'),
//        'last_name' => $request->input('last_name'),
//        'passport_number' => $request->input('password'),
//        'phone' => $request->input('phone'),
//
//    ];
//
//    // Save signature image if provided
//    if ($request->has('signature')) {
//        $signatureData = $request->input('signature');
//        $imageName = 'signature_' . time() . '.png';
//        $imagePath = 'public/signatures/' . $imageName;
//
//        // Save image to the storage folder
//        Storage::put($imagePath, base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $signatureData)));
//
//        // Provide the correct storage path for the PDF view
//        $data['signature_path'] = storage_path('app/public/signatures/' . $imageName);
//    }
//
//    // Generate and download the PDF
//    $pdf = PDF::loadView('contract.template', $data);
//    return $pdf->download('shartnoma.pdf');
//    }

    public function generatePdf(Request $request)
    {
//        dd($request->all());
        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'passport_number' => $request->input('password'),
            'phone' => $request->input('phone'),
            'additional_info' => $request->input('additionalInfo'),
        ];

        // Save signature image if provided
        if ($request->has('signature')) {
            $signatureData = $request->input('signature');
            $imageName = 'signature_' . time() . '.png';
            $imagePath = 'public/signatures/' . $imageName;

            // Save image to the storage folder
            Storage::put($imagePath, base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $signatureData)));

            // Provide the correct storage path for the PDF view
            $data['signature_path'] = storage_path('app/public/signatures/' . $imageName);
        }

        // Save data to the database
        $contract = new Contract();
        $contract->first_name = $data['first_name'];
        $contract->last_name = $data['last_name'];
        $contract->passport_number = $data['passport_number'];
        $contract->phone = $data['phone'];
        $contract->additional_info = $data['additional_info'];
        if (isset($data['signature_path'])) {
            $contract->signature_path = $data['signature_path'];
        }
        $contract->save();

        // Generate and download the PDF
        $pdf = PDF::loadView('contract.template', $data);
        return $pdf->download('shartnoma.pdf');
    }


}
