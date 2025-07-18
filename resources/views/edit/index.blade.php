<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahdi</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-900 text-white">

    <div class="flex flex-col  ">
                <h1 class="text-3xl bg-blue-500 p-4 rounded-xl">Add new post </h1>

        <a class="bg-green-500 p-4 py=8 px-8 mb-8 rounded" href="/">Back to Homepage</a>
    </div>

    <div>
        <form method="POST" action="{{route('update',$myPost->id)}}">
            @csrf
            Title : <input type="text" name="title" placeholder="Title" value="{{$myPost->title}}"><br>

            @error('title')

            <p class="bg-red-600">{{$message}}</p>
                
            @enderror
           Content : <input type="text" name="content" placeholder="Enter your content" value="{{$myPost->content}}"><br>
           @error('content')

            <p class="bg-red-600">{{$message}}</p>
                
            @enderror
           <div>
           <input type="submit" class="bg-green-500">
           </div>
        </form>
    </div>
</body>
</html>