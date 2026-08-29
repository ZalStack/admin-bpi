<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakForm;

class KontakFormController extends Controller
{
    public function index()
    {
        $forms = KontakForm::orderBy('created_at', 'desc')->get();

        return view('admin.kontak-form.index', compact('forms'));
    }

    public function show($id)
    {
        $form = KontakForm::findOrFail($id);

        return view('admin.kontak-form.show', compact('form'));
    }

    public function destroy($id)
    {
        $form = KontakForm::findOrFail($id);
        $form->delete();

        return redirect()->route('admin.kontak-form.index')
            ->with('success', 'Message deleted successfully');
    }

    public function updateStatus($id, $status)
    {
        $form = KontakForm::findOrFail($id);
        $form->status = $status;
        $form->save();

        return response()->json(['success' => true]);
    }
}
