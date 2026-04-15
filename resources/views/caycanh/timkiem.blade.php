<x-cay-canh-layout>
    <x-slot name="title">
        Kết quả tìm kiếm: "{{ $keyword }}"
    </x-slot>

    <div style="margin-top: 20px;">
        <h2>Kết quả tìm kiếm cho: "{{ $keyword }}"</h2>
        <div class="list-cay-canh">
            @forelse($sanphams as $caycanh)
            <div class="cay-canh">
                <a href="{{ url('caycanh/'.$caycanh->id) }}">
                    <img src="{{ asset('storage/image/' . $caycanh->hinh_anh) }}" alt="{{ $caycanh->ten_san_pham }}" style="width:100%; height:180px; object-fit:cover;">
                    <div style="padding: 10px; text-align:left;">
                        <div style="font-weight:700; min-height:44px;">{{ $caycanh->ten_san_pham }}</div>
                        <div style="margin-top:8px; color:#d9534f; font-weight:700;">{{ number_format($caycanh->gia_ban,0,',','.') }}đ</div>
                    </div>
                </a>
            </div>
            @empty
            <p>Không tìm thấy sản phẩm nào phù hợp với từ khóa "{{ $keyword }}".</p>
            @endforelse
        </div>
    </div>
</x-cay-canh-layout>