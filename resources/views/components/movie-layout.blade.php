<!DOCTYPE html>
<html>
    <head>
        <title>{{$title}}</title>
        <link rel="stylesheet" href="{{asset('library/bootstrap.min.css')}}">

        <script src="{{asset('library/jquery.slim.min.js')}}"></script>
        <script src="{{asset('library/popper.min.js')}}"></script>
        <script src="{{asset('library/bootstrap.bundle.min.js')}}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="{{asset('library/jquery-3.7.1.js')}}" ></script>
        <style>
            /* Định dạng màu nền và màu chữ của menu */
          
            .list-movie
            {
                display:grid;
                grid-template-columns:repeat(4,25%);
            }
            .movie
            {
                margin:10px;
                text-align:center;
                border-radius:5px;
                border:1px solid #dbdbdb;
                overflow: hidden;
                cursor:pointer;
            }
            .movie a
            {
                color: black;
                text-decoration:none;
            }
            .movie-info
            {
                display:grid;
                grid-template-columns:repeat(2,30% 70%);
            }
            .banner
            {
                width:100%;
                max-width:1200px;
                max-height:200px;
                height:65vh;
                background-image:url('{{asset('images/banner.jpg')}}');
                background-size:cover;
                color:white;
                margin:0 auto;
            }
            .search-input
            {
                width: 90%;
                position: relative;
                margin: 0 auto;
            }
            .search-input input
            {
                width:100%;
                height:40px;
                border-radius:30px;
                border:none;
                padding-left:15px;
            }
            .search-btn
            {
                width:90px; 
                height: 40px;
                color:white; 
                background-image:linear-gradient(to right, rgba(30,213,169,1) 0%, rgba(1,180,228,1) 100%);
                border-radius:30px;
                border:none;
                position: absolute;
                right: 0;
            }

            .list-group-movie a
            {
                padding:10px;
                text-decoration:none;
                color:white;

            }
            .list-group-movie a:hover
            {
                background:#000;

            }
        </style>
    </head>
    <body>
        <header style='text-align:center'>
            <div class='banner'>
                <div style="padding:20px 20px">
                    <h2>Welcome.</h2>
                    <h3>Millions of movies, TV shows and people to discover. Explore now.
                </div>
                <div class='search-input'>
                    <form method="post" action="{{url('/timkiem')}}">
                        <input type="text" name='keyword' placeholder="Nhập tên bộ phim yêu thích để tìm kiếm">
                        <button class="search-btn">Tìm kiếm</button>
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
        </header>
        <main style="max-width:1200px; margin:2px auto;">
        <div class='row'>
            <div class='col-3 pr-0'>
                <div class="card" style="width: 18rem; background-color:#222;color:white;">
                    <div class="card-header">
                    <i class="fa fa-film" aria-hidden="true"></i> <b>Thể loại phim</b>
                    </div>
                    <ul class="list-group list-group-flush list-group-movie">
                       @foreach($genre as $row)
                       <a href="{{url('/theloai/'.$row->id)}}">{{$row->genre_name_vn}}</a>
                       @endforeach
                    </ul>
                    </div>
                </div>
                    <div class='col-9'>
                         {{$slot}}
                    </div>
                </div>
            </div>  
         </div>
        </main>
    </body>
</html>