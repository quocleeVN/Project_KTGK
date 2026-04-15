<x-caycanh-layout>
    <x-slot name="title">Danh sách sản phẩm</x-slot>

    <div class="container mt-4">

        <h4 class="text-center text-primary mb-3">DANH SÁCH SẢN PHẨM</h4>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Xóa</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $total = 0;
                @endphp

                @forelse($cart as $id => $item)
                    @php
                        $total += $item['price'] * $item['qty'];
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $item['name'] }}</td>
                        <td>{{ max(1, $item['qty']) }}</td>
                        <td>{{ number_format($item['price']) }}đ</td>
                        <td>
                            <a href="{{ route('giohang.remove', $id) }}" class="btn btn-danger btn-sm">
                                Xóa
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Giỏ hàng trống</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="3"><b>Tổng cộng</b></td>
                    <td colspan="2"><b>{{ number_format($total) }}đ</b></td>
                </tr>

            </tbody>
        </table>

        <!-- THANH TOÁN -->
        <div class="text-center mt-3">
            <label><b>Hình thức thanh toán</b></label><br>

            <select class="form-select d-inline-block mt-2" style="width:200px;">
                <option>Tiền mặt</option>
                <option>Chuyển khoản</option>
            </select>
        </div>

        <div class="text-center mt-3">
            <form action="{{ route('giohang.checkout') }}" method="POST">
                @csrf
                <button class="btn btn-primary px-4">
                    ĐẶT HÀNG
                </button>
            </form>
        </div>

    </div>
</x-caycanh-layout>