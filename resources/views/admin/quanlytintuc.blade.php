@extends('admin.app')

@section('admin.body')
    <div class="adnews-main-content">
        <div class="adnews-header">
            <div class="adnews-search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Tìm kiếm tin tức..." id="adnews-searchInput">
            </div>
            <div class="adnews-user-profile">
                <div class="adnews-notification-bell adnews-tooltip" data-tooltip="Thông báo"><i class="fas fa-bell"></i>
                </div>
                <div class="adnews-profile-avatar">QT</div>
            </div>
        </div>
        <h1 class="adnews-page-title">Quản lý tin tức</h1>
        <p class="adnews-page-subtitle">Tạo, chỉnh sửa và quản lý bài viết tin tức cho cửa hàng</p>
        <div class="adnews-tab-nav">
            <button class="adnews-tab-btn adnews-active" data-tab="adnews-list">Danh sách tin tức</button>
            <button class="adnews-tab-btn" data-tab="adnews-stats">Thống kê</button>
            <button class="adnews-tab-btn" data-tab="adnews-chat">Chat tạo tin tức</button>

            <button class="adnews-tab-btn" data-tab="adnews-settings">Cài đặt tin tức</button>
        </div>
        <div class="adnews-tab-content adnews-active" id="adnews-list">
            <div class="adnews-actions">
                <form action="{{route('admin.new.index')}} " method="GET">
                    <div class="adnews-filters">



                        <div class="adnews-filter-group">
                            <label>Danh mục <i class="fas fa-list"></i></label>
                            <select id="adnews-categoryFilter" name="category_id" onchange="this.form.submit()">
                                <option value="">Tất cả</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @php
                            $uniqueStatuses = $news->pluck('status')->unique();
                        @endphp


                        <div class="adnews-filter-group">
                            <label>Trạng thái <i class="fas fa-info-circle"></i></label>
                            <select id="adnews-statusFilter" name="status" onchange="this.form.submit()">
                                <option value="">Tất cả</option>
                                @foreach ($uniqueStatuses as $status)
                                    <option value=" {{ $status }} " {{request('status') == $status ? 'selected' : ''}}>{{$status}}
                                    </option>

                                @endforeach
                                {{-- <option value="Bản nháp">Bản nháp</option> --}}
                            </select>
                        </div>


                        {{--
                        <div class="adnews-filter-group">
                            <label>Ngày <i class="fas fa-calendar"></i></label>
                            <input type="date" name="dateFillter" id="adnews-dateFilter" value=""
                                onchange="this.form.submit()">
                        </div> --}}


                        {{-- <div class="adnews-filter-group">
                            <label>Tác giả <i class="fas fa-user"></i></label>
                            <select id="adnews-authorFilter">
                                <option value="">Tất cả</option>
                                <option value="Quản Trị">Quản Trị</option>
                                <option value="Nhân Viên">Nhân Viên</option>
                            </select>
                        </div> --}}



                    </div>
                </form>
                <button class="adnews-btn adnews-btn-primary adnews-tooltip" data-tooltip="Thêm tin tức"
                    onclick="openAddModal('')">Thêm tin tức</button>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="adnews-data-card">
                <div class="adnews-table-container">
                    <table class="adnews-data-table">
                        <thead>
                            <tr>
                                <th>Hình</th>
                                <th>Tiêu đề</th>
                                <th>Danh mục</th>
                                <th>Tác giả</th>
                                <th>Lượt xem</th>
                                {{-- <th>Ngày Tạo</th> --}}
                                <th>Ngày đăng</th>
                                <th>Ngày sửa</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="adnews-newsTableBody">

                            @foreach ($news as $new)
                                <tr data-id="{{$new->id}}" data-title="{{$new->title}}"
                                    data-category="{{$new->new_category->name}}" data-author="{{$new->author}}"
                                    data-date="{{$new->created_at}}" data-status="{{$new->status}}"
                                    data-excerpt="{{$new->description}}" data-content="{{ $new->content }}"
                                    data-tags="thời trang, thu đông" data-image="{{asset('')}}img/{{$new->image}}">
                                    <td><img src="{{asset('')}}img/{{$new->image}}" alt="Thumbnail" class="adnews-thumbnail">
                                    </td>
                                    <td>{{$new->title}}</td>
                                    <td>{{$new->new_category->name}}</td>
                                    <td>{{$new->author}}</td>
                                    <td>{{$new->views}}</td>
                                    {{-- <td>{{$new->created_at}}</td> --}}
                                    <td>{{$new->posted_date}}</td>
                                    <td>{{$new->updated_at}}</td>
                                    <td><span class="adnews-status-badge" data-id="{{ $new->id }}">{{ $new->status }}</span></td>
                                    <td>
                                        <button class="adnews-btn adnews-btn-secondary adnews-tooltip" data-tooltip="Xem trước"
                                            onclick="adnewsPreviewNews({{$new->id}})">Xem</button>
                                        <button class="adnews-btn adnews-btn-primary adnews-tooltip"
                                            onclick="openEditModal({{ $new->id }})">Sửa</button>
                                        <button class="adnews-btn adnews-btn-outline adnews-tooltip" data-tooltip="Xóa"
                                            onclick="adnewsDeleteNews({{$new->id}})">Xóa</button>

                                        


                                        <button class="adnews-btn adnews-btn-toggle adnews-tooltip""
                                            onclick="adnewsTogglePublish({{ $new->id }}, '{{ $new->status }}')">
                                            {{ $new->status == "Đã xuất bản" ? "Hủy" : "Xuất bản" }}
                                        </button>

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

            <div class="adnews-pagination" id="adnews-pagination">
                @for ($i = 1; $i <= $news->lastPage(); $i++)
                    <a href="{{ $news->url($i) }}"
                        class="adnews-pagination-btn {{ $news->currentPage() == $i ? 'adnews-active' : '' }}">
                        {{ $i }}
                    </a>
                @endfor

            </div>
            {{-- <div class="adnews-pagination" id="adnews-pagination"></div> --}}

        </div>
        <div class="adnews-tab-content" id="adnews-stats">
            <div class="adnews-data-card">
                <div class="adnews-table-container">
                    <table class="adnews-data-table">
                        <thead>
                            <tr>
                                <th>Danh mục</th>
                                <th>Số bài viết đã đăng</th>
                                <th>Lượt xem tổng</th>
                                <th>Lượt xem trung bình</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>{{ $category->news_count }}</td>

                                    <td>{{$category->total_views ?? 0}}</td>
                                    <td>{{$category->total_views > 0 ? round($category->total_views / $category->news_count, 0) : 0}}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <div id="notificationArea"></div> --}}
        <div class="adnews-tab-content" id="adnews-chat">
            <!-- Form thông tin bổ sung -->

            <!-- Khu vực chat -->
            <div class="content">
                <section class="form-section">
                    <h2 class="section-title"><i class="fas fa-edit"></i> Tạo tin tức với AI của MAG</h2>

                    <div class="form-group">
                        <label for="basicIdea"><i class="fas fa-lightbulb"></i> Ý tưởng ban đầu</label>
                        <textarea id="basicIdea" placeholder="Nhập ý tưởng ban đầu..."></textarea>
                        <div class="char-count" id="ideaCount">0/500 ký tự</div>
                    </div>

                    <div class="form-group">
                        <label for="genre"><i class="fas fa-book"></i> Thể loại</label>
                        <select id="genre">
                            <option value="Giải trí" selected>Giải trí</option>
                            <option value="Trò chơi">Trò chơi</option>
                            <option value="Tâm lý">Tâm lý</option>
                            <option value="Phiêu lưu">Phiêu lưu</option>
                            <option value="Hành động">Hành động</option>
                            <option value="Tài chính - Kinh doanh">Tài chính - Kinh doanh</option>
                            <option value="Đời sống - Xã hội">Đời sống - Xã hội</option>
                            <option value="Tâm linh - Tôn giáo">Tâm linh - Tôn giáo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="length"><i class="fas fa-ruler"></i> Độ dài mong muốn (ký tự)</label>
                        <input type="number" id="length" min="1000" max="10000" value="4000">
                    </div>

                    <div class="form-group">
                        <label for="ageGroup"><i class="fas fa-users"></i> Độ tuổi</label>
                        <select id="ageGroup">
                            <option value="Mọi lứa tuổi">Mọi lứa tuổi</option>
                            <option value="Trẻ em">Trẻ em</option>
                            <option value="Thiếu niên">Thiếu niên</option>
                            <option value="Thanh niên">Thanh niên</option>
                            <option value="Người lớn">Người lớn</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-ban"></i> Nội dung bị cấm</label>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="violence" checked>
                                <label for="violence">Bạo lực</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="racism" checked>
                                <label for="racism">Phân biệt chủng tộc</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="sex" checked>
                                <label for="sex">Tình dục</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bannedWords"><i class="fas fa-exclamation-triangle"></i> Từ ngữ bị cấm (cách nhau bằng
                            dấu phẩy)</label>
                        <input type="text" id="bannedWords" placeholder="Ví dụ: chết chóc, máu me, khiêu dâm...">
                    </div>

                    <button id="generateBtn">
                        <i class="fas fa-magic"></i> Tạo với AI
                    </button>

                    <div class="ai-indicator">
                        <i class="fas fa-brain"></i> AI đang sử dụng công nghệ GPT-4 để tạo nội dung
                    </div>
                </section>

                <section class="result-section">
                    {{-- <h2 class="section-title"><i class="fas fa-book-open"></i> Câu chuyện được tạo</h2> --}}

                    <div id="notificationArea" class="notification"></div>

                    <div class="result-container">
                        <div id="story_img"></div>
                        <div id="storyOutput">
                            <div class="instruction-text">Nhập thông tin và nhấn "Tạo truyện với AI" để bắt đầu quá trình
                                tạo
                                truyện tự động.</div>
                        </div>
                    </div>
                </section>
            </div>
        </div>







        {{-- setting --}}
        <div class="adnews-tab-content" id="adnews-settings">
            <div class="adnews-form-group">
                <label>Số bài mỗi trang <i class="fas fa-list-ol"></i></label>
                <select id="adnews-postsPerPage">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="adnews-form-group adnews-checkbox-group">
                <label><input type="checkbox" checked> Cho phép bình luận</label>
                <label><input type="checkbox"> Tự động duyệt bình luận</label>
            </div>
            <div class="adnews-form-group">
                <label>Thêm danh mục mới <i class="fas fa-plus"></i></label>
                <input type="text" id="adnews-newCategory" placeholder="Nhập tên danh mục">
                <button class="adnews-btn adnews-btn-primary" onclick="adnewsAddCategory()">Thêm</button>
            </div>
            <div class="adnews-category-list">
                <div class="adnews-category-item">
                    <span>Khuyến mãi</span>
                    <button class="adnews-btn adnews-btn-outline" onclick="adnewsDeleteCategory('Khuyến mãi')">Xóa</button>
                </div>
                <div class="adnews-category-item">
                    <span>Bộ sưu tập</span>
                    <button class="adnews-btn adnews-btn-outline" onclick="adnewsDeleteCategory('Bộ sưu tập')">Xóa</button>
                </div>
                <div class="adnews-category-item">
                    <span>Tin tức chung</span>
                    <button class="adnews-btn adnews-btn-outline"
                        onclick="adnewsDeleteCategory('Tin tức chung')">Xóa</button>
                </div>
            </div>
            <div class="adnews-form-actions">
                <button class="adnews-btn adnews-btn-primary adnews-tooltip" data-tooltip="Lưu cài đặt"
                    onclick="adnewsSaveSettings()">Lưu</button>
                <button class="adnews-btn adnews-btn-secondary adnews-tooltip" data-tooltip="Hủy"
                    onclick="adnewsCancelSettings()">Hủy</button>
            </div>
        </div>



        {{-- thêm --}}
        <div class="adnews-modal" id="addModal" style="display:none;">
            <div class="adnews-modal-content">
                <form action="{{ route('admin.new.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2>Thêm bài viết tin tức</h2>

                    <!-- Title -->
                    <div class="adnews-form-group">
                        <label>Tiêu đề</label>
                        <input type="text" name="title" placeholder="Nhập tiêu đề">
                    </div>

                    <!-- Description -->
                    <div class="adnews-form-group">
                        <label>Mô tả</label>
                        <textarea name="description"></textarea>
                    </div>

                    <!-- Content -->
                    <div class="adnews-form-group">
                        <label>Nội dung</label>
                        <textarea name="content"></textarea>
                    </div>

                    <!-- Author -->
                    <div class="adnews-form-group">
                        <label>Tác giả</label>
                        <input type="text" name="author">
                    </div>

                    <!-- Category -->
                    <div class="adnews-form-group">
                        <label>Danh mục</label>
                        <select name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Posted Date -->
                    <div class="adnews-form-group">
                        <label>Ngày đăng</label>
                        <input type="datetime-local" name="posted_date">
                    </div>

                    <!-- Image -->
                    <div class="adnews-form-group">
                        <label>Hình ảnh</label>
                        <input type="file" name="image" accept="image/*">
                    </div>

                    <div class="adnews-modal-actions">
                        <button type="button" onclick="closeAddModal()">Hủy</button>
                        <button type="submit">Lưu</button>
                    </div>
                </form>
            </div>
        </div>


        {{-- sửa --}}

        <div class="adnews-modal" id="editModal" style="display:none;">
            <div class="adnews-modal-content">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h2>Chỉnh sửa bài viết tin tức</h2>

                    <!-- Title -->
                    <div class="adnews-form-group">
                        <label>Tiêu đề</label>
                        <input type="text" name="title" id="editTitle">
                    </div>

                    <!-- Description -->
                    <div class="adnews-form-group">
                        <label>Mô tả</label>
                        <textarea name="description" id="editDescription"></textarea>
                    </div>

                    <!-- Content -->
                    <div class="adnews-form-group">
                        <label>Nội dung</label>
                        <textarea name="content" id="editContent"></textarea>
                    </div>

                    <!-- Author -->
                    <div class="adnews-form-group">
                        <label>Tác giả</label>
                        <input type="text" name="author" id="editAuthor">
                    </div>

                    <!-- Category -->
                    <div class="adnews-form-group">
                        <label>Danh mục</label>
                        <select name="category_id" id="editCategory">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Posted Date -->
                    <div class="adnews-form-group">
                        <label>Ngày đăng</label>
                        <input type="datetime-local" name="posted_date" id="editDate">
                    </div>

                    <!-- Image -->
                    <div class="adnews-form-group">
                        <label>Hình ảnh</label>
                        <input type="file" name="image" id="editImage" accept="image/*">
                    </div>

                    <div class="adnews-modal-actions">
                        <button type="button" onclick="closeEditModal()">Hủy</button>
                        <button type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>


        {{-- xem bài viết --}}
        <div class="adnews-modal" id="adnews-previewModal">
            <div class="adnews-modal-content">
                <h2 id="adnews-previewTitle">Xem bài viết</h2>
                <img id="adnews-previewImage" class="adnews-image-preview" alt="News Image">
                <p id="adnews-previewExcerpt" style="margin: 1rem 0; color: var(--text-muted);"></p>
                <div id="adnews-previewContent" style="font-size: 0.9rem;"></div>
                <div class="adnews-modal-actions">
                    <button class="adnews-btn adnews-btn-primary adnews-tooltip" data-tooltip="Đóng"
                        onclick="adnewsCloseModal('preview')">Đóng</button>
                </div>
            </div>
        </div>






        <script>
            // document.addEventListener('DOMContentLoaded', () => {

            // đóng
            window.adnewsCloseModal = function (type = 'news') {
                document.getElementById(type === 'preview' ? 'adnews-previewModal' : 'adnews-newsModal').style.display = 'none';
                const formGroups = document.querySelectorAll('#adnews-newsModal .adnews-form-group');
                formGroups.forEach(group => group.classList.remove('adnews-error'));
            };
            // Open/Close Add
            function openAddModal() {
                document.getElementById('addModal').style.display = 'flex';
            }
            function closeAddModal() {
                document.getElementById('addModal').style.display = 'none';
            }

            // Open/Close Edit
            function openEditModal(id) {
                const row = document.querySelector(`tr[data-id="${id}"]`);
                const form = document.getElementById('editForm');
                form.action = `/admin/news/update/${id}`;
                document.getElementById('editTitle').value = row.dataset.title;
                document.getElementById('editDescription').value = row.dataset.excerpt;
                document.getElementById('editContent').value = row.dataset.content;
                document.getElementById('editAuthor').value = row.dataset.author;
                document.getElementById('editCategory').value = row.dataset.categoryId;
                document.getElementById('editDate').value = row.dataset.postedDate;
                document.getElementById('editModal').style.display = 'flex';
            }
            function closeEditModal() {
                document.getElementById('editModal').style.display = 'none';
            }
            // Sidebar interaction


            document.querySelectorAll('.adnews-sidebar-item').forEach(item => {
                item.addEventListener('click', e => {
                    e.preventDefault();
                    document.querySelectorAll('.adnews-sidebar-item').forEach(i => i.classList.remove('adnews-active'));
                    item.classList.add('adnews-active');
                });
            });

            // Tab navigation

            document.querySelectorAll('.adnews-tab-btn').forEach(button => {
                button.addEventListener('click', () => {
                    document.querySelectorAll('.adnews-tab-btn').forEach(btn => btn.classList.remove('adnews-active'));
                    document.querySelectorAll('.adnews-tab-content').forEach(content => content.classList.remove('adnews-active'));
                    button.classList.add('adnews-active');
                    document.getElementById(button.dataset.tab).classList.add('adnews-active');
                });
            });




            // Tab navigation
            document.querySelectorAll('.adnews-tab-btn').forEach(button => {
                button.addEventListener('click', () => {
                    document.querySelectorAll('.adnews-tab-btn').forEach(btn => btn.classList.remove('adnews-active'));
                    document.querySelectorAll('.adnews-tab-content').forEach(content => content.classList.remove('adnews-active'));
                    button.classList.add('adnews-active');
                    document.getElementById(button.dataset.tab).classList.add('adnews-active');
                });
            });
            // Delete news

            window.adnewsDeleteNews = function (id) {
                if (confirm('Bạn có chắc muốn xóa bài viết này?')) {
                    fetch(`/admin/news/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.querySelector(`tr[data-id="${id}"]`).remove();
                                alert('Tin tức đã được xóa.');
                            }
                        });
                }
            };



            // window.adnewsTogglePublish = function(id, status){
            //     if(status == "Đã xuất bản"){
            //         if(confirm('Bạn có chắc muốn hủy xuất bản không?')){

            //         }
            //     }else{
            //         if(confirm('Bạn có chắc muốn xuất bản không?')){

            //         }
            //     }
            // }

            // window.adnewsTogglePublish = function (id, currentLabel) {
            //     // Xác định hành động và thông báo
            //     const newStatus = currentLabel === 'Chưa xuất bản' ? 'Đã xuất bản' : 'Chưa xuất bản';


            //     const confirmMsg = newStatus === 'Đã xuất bản'
            //         ? 'Bạn có chắc muốn xuất bản không?'
            //         : 'Bạn có chắc muốn hủy xuất bản không?';


            //     if (!confirm(confirmMsg)) return;

            //     // Lấy CSRF token
            //     const token = document.querySelector('meta[name="csrf-token"]').content;

            //     fetch(`/api/news/${id}/status`, {
            //         method: 'PATCH',
            //         headers: {
            //             'Content-Type': 'application/json',
            //             'X-CSRF-TOKEN': token
            //         },
            //         body: JSON.stringify({ status: newStatus })
            //     })
            //         .then(res => res.ok
            //             ? res.json()
            //             : res.json().then(err => Promise.reject(err.message || 'Lỗi server'))


            //         )
            //         .then(data => {
            //             if (!data.success) throw data.message;
            //             // Cập nhật badge và button styles
            //             const badges = document.querySelectorAll(".adnews-status-badge");
            //             const buttons = document.querySelectorAll(".adnews-btn-toggle");

            //             badges.forEach(badge => {
            //                 // badge.className = 'adnews-status-badge';
            //                 badge.style.cssText = newStatus === 'Đã xuất bản'
            //                     ? 'background-color: #DCFCE7; color: #166534; padding: 0.25rem 0.5rem; border-radius: 0.25rem;'
            //                     : 'background-color: #F3F4F6; color: #1F2937; padding: 0.25rem 0.5rem; border-radius: 0.25rem;';
            //                 badge.textContent = newStatus;
            //             });

            //             buttons.forEach(btn => {
            //                 btn.className = 'adnews-btn adnews-btn-toggle';
            //                 btn.style.cssText = newStatus === 'Đã xuất bản'
            //                     ? 'border: 1px solid #EF4444; color: #EF4444;'
            //                     : 'background-color: #2563EB; color: #FFFFFF;';
            //                 btn.textContent = newStatus === 'Đã xuất bản' ? 'Hủy xuất bản' : 'Xuất bản';
            //                 btn.setAttribute('data-tooltip',
            //                     newStatus === 'Đã xuất bản' ? 'Hủy xuất bản tin' : 'Xuất bản tin');
            //                 btn.setAttribute('onclick',
            //                     `adnewsTogglePublish(${id}, '${newStatus}')`);
            //             });



            //             location.reload();

            //         })
            //         .catch(err => {
            //             console.error(err);
            //             alert(err);
            //         });
            // };



            window.adnewsTogglePublish = function (id, currentLabel) {
                // Xác định trạng thái mới
                const newStatus = currentLabel === 'Chưa xuất bản' ? 'Đã xuất bản' : 'Chưa xuất bản';
                // Thông báo xác nhận
                const confirmMsg = newStatus === 'Đã xuất bản'
                    ? 'Bạn có chắc muốn xuất bản không?'
                    : 'Bạn có chắc muốn hủy xuất bản không?';

                if (!confirm(confirmMsg)) return;

                // Lấy CSRF token
                const token = document.querySelector('meta[name="csrf-token"]').content;

                fetch(`/api/news/${id}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                    .then(res => res.ok
                        ? res.json()
                        : res.json().then(err => Promise.reject(err.message || 'Lỗi server'))
                    )
                    .then(data => {
                        if (!data.success) throw data.message;

                        // Cập nhật badge và button styles
                        // Bỏ location.reload() để giữ các cập nhật giao diện
                        // Nếu vẫn muốn reload, có thể thêm vào đây, nhưng không khuyến khích
                        location.reload();
                    })
                    .catch(err => {
                        console.error(err);
                        alert(err);
                    });
            };

            // Add category
            window.adnewsAddCategory = function () {
                const newCategory = document.getElementById('adnews-newCategory').value.trim();
                if (newCategory) {
                    alert(`Danh mục "${newCategory}" đã được thêm (demo, không lưu thực tế).`);
                    document.getElementById('adnews-newCategory').value = '';
                } else {
                    alert('Vui lòng nhập tên danh mục.');
                }
            };


            // Delete category
            window.adnewsDeleteCategory = function (category) {
                if (confirm(`Bạn có chắc muốn xóa danh mục "${category}"?`)) {
                    alert(`Danh mục "${category}" đã được xóa (demo, không xóa thực tế).`);
                }
            };
            // Cancel settings
            window.adnewsCancelSettings = function () {
                alert('Đã hủy thay đổi cài đặt.');
                document.getElementById('adnews-postsPerPage').value = '10';
                document.querySelectorAll('#adnews-settings input[type="checkbox"]').forEach(cb => cb.checked = cb.defaultChecked);
                document.getElementById('adnews-newCategory').value = '';
                adnewsPostsPerPage = 10;
                adnewsUpdateTable();
            };


            // Image preview
            // document.getElementById('adnews-newsImage').addEventListener('change', () => {
            //     const file = document.getElementById('adnews-newsImage').files[0];
            //     if (file) {
            //         const reader = new FileReader();
            //         reader.onload = function (e) {
            //             document.getElementById('adnews-imagePreview').src = e.target.result;
            //             document.getElementById('adnews-imagePreview').style.display = 'block';
            //         };
            //         reader.readAsDataURL(file);
            //     } else {
            //         document.getElementById('adnews-imagePreview').style.display = 'none';
            //     }

            //     // });

            //     // Initial render
            //     adnewsUpdateTable();



            // });

        </script>


        <script>




            const basicIdea = document.getElementById('basicIdea');
            const generateBtn = document.getElementById('generateBtn');
            const storyOutput = document.getElementById('storyOutput');
            const notificationArea = document.getElementById('notificationArea');
            const ideaCount = document.getElementById('ideaCount');
            const storyImg = document.getElementById('story_img');
            // Cập nhật số ký tự
            basicIdea.addEventListener('input', function () {
                ideaCount.textContent = `${basicIdea.value.length}/500 ký tự`;
            });
            ideaCount.textContent = `${basicIdea.value.length}/500 ký tự`;

            // Xử lý sự kiện khi nhấn nút "Tạo truyện với AI"
            generateBtn.addEventListener('click', async function () {
                const idea = basicIdea.value.trim();
                const genre = document.getElementById('genre').value;
                const length = document.getElementById('length').value;
                const ageGroup = document.getElementById('ageGroup').value;
                const bannedWords = document.getElementById('bannedWords').value;
                const bannedContent = {
                    violence: document.getElementById('violence').checked,
                    racism: document.getElementById('racism').checked,
                    sex: document.getElementById('sex').checked
                };

                // Kiểm tra đầu vào
                if (!idea) {
                    showNotification('Vui lòng nhập ý tưởng ban đầu cho câu chuyện!', 'error');
                    return;
                }
                if (idea.length > 500) {
                    showNotification('Ý tưởng ban đầu không được vượt quá 500 ký tự!', 'error');
                    return;
                }

                // Hiển thị loading
                storyOutput.innerHTML = '<div class="loading"><div class="spinner"></div></div>';

                try {
                    // Gửi yêu cầu đến backend
                    const response = await fetch('http://127.0.0.1:8000/api/create-blog-ai', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            basic_idea: idea,
                            genre: genre,
                            story_length: length,
                            age_group: ageGroup,
                            banned_words: bannedWords,
                            banned_content: JSON.stringify(bannedContent)
                        })
                    });

                    const data = await response.json();

                    if (data.error) {
                        showNotification(data.error, 'error');
                        storyOutput.innerHTML = '';
                    } else {
                        const story = data.story;
                        const imageUrl = data.image_url; // Lấy URL của ảnh từ backend



                        const titleMatch = story.match(/<TIEUDE>(.*?)<\/TIEUDE>/);
                        const contentMatch = story.match(/<NOIDUNG>(.*?)<\/NOIDUNG>/s);
                        const title = titleMatch ? titleMatch[1] : "Câu chuyện của bạn";
                        const content = contentMatch ? contentMatch[1] : story;


                        const Output = `
                                                                        <div class="story-title">${title}</div>
                                                                         <img src="${imageUrl}" alt="Hình ảnh" style="max-width: 100%; height: auto; margin-bottom: 20px;">
                                                                         >${content}
                                                                    `;

                        // storyImg.innerHTML = imgOutput
                        storyOutput.innerHTML = Output;
                        showNotification('Câu chuyện đã được tạo thành công!', 'success');
                    }
                } catch (error) {
                    showNotification('Đã xảy ra lỗi khi kết nối đến server!', 'error');
                    storyOutput.innerHTML = '';
                }
            });

            // Hàm hiển thị thông báo
            function showNotification(message, type) {
                notificationArea.innerHTML = `<div class="notification ${type}">${message}</div>`;
                setTimeout(() => {
                    notificationArea.innerHTML = '';
                }, 5000);
            }











            // Preview news
            window.adnewsPreviewNews = function (id) {
                const modal = document.getElementById('adnews-previewModal');
                const previewTitle = document.getElementById('adnews-previewTitle');
                const previewImage = document.getElementById('adnews-previewImage');
                const previewExcerpt = document.getElementById('adnews-previewExcerpt');
                const previewContent = document.getElementById('adnews-previewContent');

                const row = document.querySelector(`tr[data-id="${id}"]`);
                previewTitle.textContent = row.dataset.title;
                previewImage.src = row.dataset.image;
                previewImage.style.display = 'block';
                previewExcerpt.textContent = row.dataset.excerpt;
                // Sử dụng innerHTML để hiển thị nội dung HTML
                previewContent.innerHTML = row.dataset.content;
                modal.style.display = 'flex';
            };



            // });



            // function adnewsUpdateTable() {
            //     const start = (adnewsCurrentPage - 1) * adnewsPostsPerPage;
            //     const end = start + adnewsPostsPerPage;
            //     adnewsRows.forEach((row, index) => {
            //         row.style.display = (index >= start && index < end) ? '' : 'none';
            //     });
            //     adnewsUpdatePagination();
            // }










            // // Save settings
            // window.adnewsSaveSettings = function () {
            //     const saveBtn = document.querySelector('#adnews-settings .adnews-btn-primary');
            //     saveBtn.classList.add('adnews-loading');
            //     saveBtn.disabled = true;
            //     setTimeout(() => {
            //         saveBtn.classList.remove('adnews-loading');
            //         saveBtn.disabled = false;
            //         alert('Cài đặt đã được lưu (demo, không lưu thực tế).');
            //     }, 1000);
            // };



        </script>
@endsection