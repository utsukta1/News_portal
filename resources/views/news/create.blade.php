<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="d-flex justify-content-end">
        <a href="{{route('news.index')}}" class="btn btn-dark">Back</a>
    </div>
    <div>
        <form action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="">Title</label>
                <input value="{{old('title')}}" type="text" placeholder="title" name="title">
                @error('title')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">Author</label>
                <input type="text" value="{{old('author')}}" name="author" placeholder="Author">
                @error('author')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">Description</label>
                <textarea name="description" id="descriptiom" cols="30" rows="10">{{old('description')}}</textarea>
                @error('description')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">Image</label>
                <input type="file" name="title" placeholder="Title">
            </div>
            <button>Submit</button>


        </form>
    </div>
  </body>
</html>