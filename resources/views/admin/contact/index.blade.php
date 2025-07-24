@extends('admin.app')

<style>
.qllh-main {
  padding: 24px;
  background-color: #f4f6f9;
  min-height: 100vh;
  width: 90%;
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

.filter-form {
  display: flex;
  gap: 12px;
  margin-bottom: 16px;
  align-items: center;
}

.filter-form input,
.filter-form select,
.filter-form button {
  padding: 8px 12px;
  border: 1px solid #d1d5db;
  border-radius: 6px;
  font-size: 14px;
}

.filter-form button {
  background-color: #4f46e5;
  color: white;
  font-weight: 500;
  cursor: pointer;
  transition: 0.2s;
}

.filter-form button:hover {
  opacity: 0.9;
}

.table-container {
  background: #ffffff;
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
  color: white;
  font-weight: 600;
  white-space: nowrap;
}

td {
  background-color: #ffffff;
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

.btn {
  padding: 6px 14px;
  font-size: 14px;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 500;
  transition: 0.2s;
  margin-right: 4px;
}

.btn-view {
  background-color: #f3f4f6;
  color: #111827;
}

.btn-delete {
  background-color: #ef4444;
  color: white;
  border: none;
}

.btn:hover {
  opacity: 0.9;
  cursor: pointer;
}
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 24px;
  gap: 6px;
  flex-wrap: wrap;
}

.pagination .page-item {
  list-style: none;
}

.pagination .page-link {
  display: inline-block;
  padding: 8px 14px;
  color: #4f46e5;
  background-color: white;
  border: 1px solid #d1d5db;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 500;
  transition: all 0.2s;
  text-decoration: none;
}

.pagination .page-link:hover {
  background-color: #4f46e5;
  color: white;
}

.pagination .active .page-link {
  background-color: #4f46e5;
  color: white;
  border-color: #4f46e5;
  font-weight: 600;
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

  th, td {
    padding: 12px;
  }
}
</style>

@section('admin.body')
  <div class="qllh-main">
    <div class="qllh-header">
      <h1>Quản lý liên hệ</h1>
    </div>

    {{-- Form tìm kiếm và lọc --}}
    <form method="GET" action="{{ route('admin.quanlylienhe.index') }}" class="filter-form">
      <input type="text" name="keyword" placeholder="Tìm theo tên, email..." value="{{ request('keyword') }}">
      <select name="status">
        <option value="">-- Tất cả trạng thái --</option>
        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Đã phản hồi</option>
        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Chưa phản hồi</option>
      </select>
      <button type="submit">Lọc</button>
    </form>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Điện thoại</th>
            <th>Chủ đề</th>
            <th>Trạng thái</th>
            <th>Thời gian</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($contacts as $contact)
            <tr>
              <td>{{ $contact->id }}</td>
              <td>{{ $contact->name }}</td>
              <td>{{ $contact->email }}</td>
              <td>{{ $contact->phone }}</td>
              <td>{{ $contact->subject }}</td>
              <td>
                @if($contact->status)
                  <span class="status-active">Đã phản hồi</span>
                @else
                  <span class="status-inactive">Chưa phản hồi</span>
                @endif
              </td>
              <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
              <td>
                <a href="{{ route('admin.quanlylienhe.show', $contact->id) }}" class="btn btn-view">Xem</a>
                <form action="{{ route('admin.quanlylienhe.destroy', $contact->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-delete" onclick="return confirm('Xóa liên hệ này?')">Xóa</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="8" style="text-align: center; padding: 20px;">Không có liên hệ nào.</td></tr>
          @endforelse
        </tbody>
      </table>

 <div style="margin-top: 20px;">
  {{ $contacts->withQueryString()->links() }}
</div>
    </div>

@endsection
