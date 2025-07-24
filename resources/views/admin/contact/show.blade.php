@extends('admin.app')

@section('admin.body')
  <style>
    .contact-detail-wrapper {
      padding: 40px;
      background-color: #f4f6f9;
      min-height: 100vh;
      width: 90%;
    }

    .contact-detail-box {
      background-color: #fff;
      padding: 32px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      width: 100%;
    }

    .contact-detail-box h2 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 24px;
      color: #1f2937;
    }

    .detail-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 16px;
      margin-bottom: 24px;
    }

    .detail-item {
      font-size: 15px;
      line-height: 1.6;
      padding: 12px 16px;
      background-color: #f9fafb;
      border-radius: 6px;
    }

    .detail-item strong {
      display: inline-block;
      width: 100px;
      color: #4b5563;
    }

    textarea.form-control {
      width: 100%;
      padding: 12px;
      font-size: 14px;
      border-radius: 8px;
      border: 1px solid #d1d5db;
      margin-top: 6px;
      resize: vertical;
    }

    .btn-primary {
      background-color: #3b82f6;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      border: none;
      font-weight: 600;
      margin-top: 16px;
      cursor: pointer;
      transition: 0.2s ease;
    }

    .btn-primary:hover {
      background-color: #2563eb;
    }

    .replied {
      margin-top: 20px;
      background-color: #ecfdf5;
      padding: 16px;
      border-left: 4px solid #10b981;
      border-radius: 6px;
      color: #065f46;
    }
  </style>

  <div class="contact-detail-wrapper">
    <div class="contact-detail-box">
      <h2>Chi tiết liên hệ #{{ $contact->id }}</h2>

      <div class="detail-grid">
        <div class="detail-item"><strong>Họ tên:</strong> {{ $contact->name }}</div>
        <div class="detail-item"><strong>Email:</strong> {{ $contact->email }}</div>
        <div class="detail-item"><strong>Điện thoại:</strong> {{ $contact->phone ?? 'Không có' }}</div>
        <div class="detail-item"><strong>Chủ đề:</strong> {{ $contact->subject ?? 'Không có' }}</div>
        <div class="detail-item" style="grid-column: span 2;"><strong>Nội dung:</strong> {{ $contact->message }}</div>
      </div>

      @if (!$contact->status)
        <form method="POST" action="{{ route('admin.quanlylienhe.reply', $contact->id) }}">
          @csrf
          <label><strong>Phản hồi:</strong></label>
          <textarea name="reply" class="form-control" rows="5" placeholder="Nhập nội dung phản hồi..." required></textarea>
          <button type="submit" class="btn-primary">Gửi phản hồi</button>
        </form>
      @else
        <div class="replied">
          <strong>Phản hồi đã gửi:</strong><br>
          {{ $contact->reply }}
        </div>
      @endif
    </div>
  </div>
@endsection
