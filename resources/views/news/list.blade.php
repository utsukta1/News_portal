<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="d-flex justify-content-end">
        <a href="{{route('news.create')}}" class="btn btn-dark">Create</a>
    </div>
    @if (Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
    @endif
    <table class="table">
        <tr>
            <th>ID</th>
            <th></th>
            <th>Title</th>
            <th>Author</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
        @if ($news -> isNotEmpty())
        @foreach ($news as $news )
            <tr>
                <td>{{$news->id}}</td>
                <td>
                    @if ($news-> image != "")
                    <img width="50" src="{{asset('uploads/news/'.$news->image)}}" alt="news image">
                @endif
                </td>
                <td>{{$news->title}}</td>
                <td>{{$news->author}}</td>
                <td>{{\Carbon\Carbon::parse($news->created_at) -> format('d M, Y')}}</td>
                <td>
                    <a href="{{route('news.edit',$news->id)}}" class="btn btn-dark">Edit</a>
                    <a href="#" onclick="deleteNews({{$news->id}});" class="btn btn-danger">Delete</a>
                    <form id="delete-from-{{$news->id}}" action="{{route('news.destroy',$news->id)}}" method="post">
                        @csrf
                        @method('delete') 
                    </form>
                </td>
    
            </tr>
            
        @endforeach
        @endif
    </table>
  </body>
</html>
<script>
    function deleteNews(id){
        if(confirm('Are you sure you want to delete this record?')){
            document.getElementById('delete-from-'+id).submit();
        }
    }
</script>