@extends('admin.app')

@section('admin.body')
  <style>
  .qllh-main {
  padding: 24px;
  background-color: #f4f6f9;
  min-height: 100vh;
  width: 90%; /* Đảm bảo chiếm toàn bộ chiều ngang */
}


    .qllh-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }

    .qllh-header h1 {
      font-size: 24px;
      color: #111827;
      margin: 0;
    }

    .table-container {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 1000px;
    }

    th, td {
      padding: 16px 20px;
      border-bottom: 1px solid #e5e7eb;
      text-align: left;
    }

    th {
      background-color: #4f46e5;
      color: #fff;
      font-weight: 600;
      white-space: nowrap;
    }

    td {
      background-color: #fff;
      white-space: nowrap;
    }

    tr:last-child td {
      border-bottom: none;
    }

    .status-active {
      color: #10b981;
      background-color: #d1fae5;
      padding: 4px 10px;
      border-radius: 9999px;
      font-size: 14px;
      display: inline-block;
    }

    .status-inactive {
      color: #6b7280;
      background-color: #e5e7eb;
      padding: 4px 10px;
      border-radius: 9999px;
      font-size: 14px;
      display: inline-block;
    }

    .action-btn {
      display: flex;
      gap: 8px;
    }

    .btn {
      padding: 6px 14px;
      font-size: 14px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.2s;
    }

    .btn-ph {
      background-color: #6366f1;
      color: #fff;
    }

    .btn-view {
      background-color: #f3f4f6;
      color: #111827;
    }

    .btn-delete {
      background-color: #ef4444;
      color: #fff;
    }

    .btn:hover {
      opacity: 0.9;
    }

    @media (max-width: 768px) {
      .qllh-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }

      table {
        font-size: 14px;
      }
    }
  </style>

  <div class="qllh-main">
    <div class="qllh-header">
      <h1>Quản lý liên hệ</h1>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Điện thoại</th>
            <th>Chủ đề</th>
            <th>Tin nhắn</th>
            <th>Trạng thái</th>
            <th>Thời gian</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Khoi</td>
            <td>khoidps38721@gmail.com</td>
            <td>0918740422</td>
            <td>đấsd</td>
            <td>dfgfdg</td>
            <td><span class="status-active">Chưa phản hồi</span></td>
            <td>01/07/2025 08:30</td>
            <td class="action-btn">
              <a href="#" class="btn btn-ph">Phan hoi</a>
              <a href="{{ route('admin.quanlylienhe.show', $contact->id) }}" class="btn btn-view">Xem</a>

<form action="{{ route('admin.quanlylienhe.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-delete">Xóa</button>
</form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@endsection
