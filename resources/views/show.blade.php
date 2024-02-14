    @extends('app')
    @section('content')
    <div class="container-fluid" data-aos="fade" data-aos-delay="500">
        <div class="row">

            @foreach($data as $key => $item)
        <div class="col-lg-4">

                        <div class="image-wrap-2">
                            <div class="image-info">
                                <h2 class="mb-3">{{$item->category_name}}</h2>
                                <a href="{{ url('/stories/'.$item->id) }}" class="btn btn-outline-white py-2 px-4">More Story</a>
                            </div>
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Nature Image" class="img-fluid">


                        </div>
                    </div>
            @endforeach

            <!-- Tambahkan kode untuk gambar-gambar lainnya di sini -->
        </div>
    </div>
    @endsection
