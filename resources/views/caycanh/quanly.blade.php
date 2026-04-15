<x-cay-canh-layout>
    <x-slot name="title">
        Quản lý sản phẩm
    </x-slot>

    <div style="margin-top: 20px;">
        <div style="text-align: center; color: #0033cc; font-weight: bold; font-size: 24px; margin-bottom: 20px;">
            QUẢN LÝ SẢN PHẨM
        </div>

        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div></div>
            <a href="{{ route('sanpham.them') }}" class="btn btn-success">Thêm</a>
        </div>

        <div class="table-responsive">
            <table id="quanly-sanpham-table" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Tên khoa học</th>
                        <th>Tên thông thường</th>
                        <th>Độ khó</th>
                        <th>Yêu cầu ánh sáng</th>
                        <th>Nhu cầu nước</th>
                        <th>Giá bán</th>
                        <th>Ảnh</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#quanly-sanpham-table').DataTable({
                serverSide: true,
                ajax: {
                    url: '{{ url("quan-ly-san-pham") }}',
                    type: 'GET'
                },
                paging: true,
                searching: true,
                lengthChange: true,
                pageLength: 10,
                language: {
                    search: 'Search:',
                    lengthMenu: 'Hiển thị _MENU_ dòng',
                    paginate: {
                        first: 'Đầu',
                        last: 'Cuối',
                        next: 'Sau',
                        previous: 'Trước'
                    },
                    zeroRecords: 'Không tìm thấy kết quả phù hợp',
                    info: 'Hiển thị _START_ đến _END_ của _TOTAL_ dòng',
                    infoEmpty: 'Hiển thị 0 đến 0 của 0 dòng',
                    infoFiltered: '(lọc từ _MAX_ dòng)',
                },
                columns: [{
                        data: 0,
                        orderable: true
                    },
                    {
                        data: 1,
                        orderable: true
                    },
                    {
                        data: 2,
                        orderable: true
                    },
                    {
                        data: 3,
                        orderable: true
                    },
                    {
                        data: 4,
                        orderable: true
                    },
                    {
                        data: 5,
                        orderable: true
                    },
                    {
                        data: 6,
                        orderable: true
                    },
                    {
                        data: 7,
                        orderable: false
                    },
                    {
                        data: 8,
                        orderable: false
                    }
                ]
            });
        });
    </script>
</x-cay-canh-layout>