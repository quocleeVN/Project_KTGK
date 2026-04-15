<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Xác nhận đơn hàng</title>
</head>

<body>
    <h2>Xin chào {{ $user->name ?? $user->email }},</h2>
    <p>Cảm ơn bạn đã đặt hàng. Dưới đây là thông tin đơn hàng của bạn:</p>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @php $index = 1; @endphp
            @foreach($cart as $item)
            <tr>
                <td>{{ $index++ }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['qty'] }}</td>
                <td>{{ number_format($item['price'], 0, ',', '.') }} đ</td>
                <td>{{ number_format($item['price'] * $item['qty'], 0, ',', '.') }} đ</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Tổng cộng</strong></td>
                <td><strong>{{ number_format($total, 0, ',', '.') }} đ</strong></td>
            </tr>
        </tbody>
    </table>

    <p>Chúng tôi sẽ liên hệ với bạn sớm nhất có thể.</p>
    <p>Trân trọng,</p>
    <p>Đội ngũ cửa hàng</p>
</body>

</html>