<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactAdminController extends Controller
{
    public function index(Request $request)
{
    $query = Contact::query();

    // Tìm kiếm theo keyword (name, email)
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function($q) use ($keyword) {
            $q->where('name', 'like', "%$keyword%")
              ->orWhere('email', 'like', "%$keyword%");
        });
    }

    // Lọc theo trạng thái
    if ($request->has('status') && $request->status !== '') {
        $query->where('status', $request->status);
    }

  $contacts = $query->orderBy('id', 'asc')->paginate(10); // mỗi trang 10 mục


    return view('admin.contact.index', compact('contacts'));
}


    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.show', compact('contact'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->reply = $request->reply;
        $contact->status = 1;
        $contact->save();

        // Gửi email phản hồi
      Mail::send('emails.admin_reply', [
    'name' => $contact->name,
    'reply' => $request->reply
], function ($message) use ($contact) {
    $message->to($contact->email)
            ->subject('Phản hồi từ Admin - MAG');
});


        return redirect()->route('admin.quanlylienhe.index')->with('success', 'Đã phản hồi liên hệ!');
    }

    public function destroy($id)
    {
        Contact::destroy($id);
        return back()->with('success', 'Xóa thành công!');
    }
}
