<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      padding-bottom: 50px;
      color: #333;
    }

    .main-header {
      background-color: #333;
      color: white;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 25px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      font-weight: 600;
      font-size: 1rem;
      transition: color 0.3s, text-decoration 0.3s;
    }

    .nav-links a:hover {
      color: #ffd700;
      text-decoration: underline;
    }

    .categories {
      max-width: 600px;
      margin: 40px auto;
      background: white;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .categories h2 {
      margin-bottom: 25px;
      color: #222;
      font-weight: 700;
      font-size: 1.8rem;
      text-align: center;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    label {
      font-weight: 600;
      font-size: 1.1rem;
      color: #444;
    }

    input[type="text"] {
      padding: 12px 15px;
      font-size: 1rem;
      border: 2px solid #ddd;
      border-radius: 6px;
      transition: border-color 0.3s;
    }

    input[type="text"]:focus {
      border-color: #333;
      outline: none;
    }

    button {
      padding: 12px 20px;
      font-size: 1rem;
      background-color: #333;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #555;
    }

    .alert {
      max-width: 600px;
      margin: 30px auto;
      padding: 15px 20px;
      border-radius: 8px;
      font-weight: 600;
      text-align: center;
    }

    .error {
      color: red;
      margin-left: 10px;
      font-size: 0.9em;
    }
  </style>
</head>

<body>


  <!-- @if($message = Session::get('email'))
        <div class="alert alert-success" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @endif -->


  <header class="main-header">
    <h1> <a href="{{ route('admin-dashboard') }}">Quiz Questions</a></h1>
    <nav>


      <ul class="nav-links">
        <li><a href="{{ route('categories') }}">Categories</a></li>
        <li><a href="#">Quiz</a></li>

        @if(Session::get('email'))
      <li><a href="#">Logout</a></li>
    @endif
      </ul>


    </nav>
  </header>
  @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
    <strong>{{ $message }}</strong>
    </div>
  @endif

  <div class="categories">
    <h2>Add Categories</h2>
    <form action="{{ route('categories-add') }}" method="post">
      @csrf
      <span class="error" id="categoriesError"></span>
      <label for="addCategories">Add Categories</label>
      <input type="text" name="name" id="nameCategories">
      <button type="submit" id="btnCayegoryAdded">Add Category</button>
    </form>
  </div>


  <!-- Added Categories fetch  -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      // Ckeck from DB , searching input is alreday in db or not
      $('#nameCategories').keyup(function () {
        var searchValue = $('#nameCategories').val();

        $.ajax({
          url: "{{ route('search-categories') }}",
          method: "POST",
          data: {
            searchValue: searchValue,
            _token: "{{ csrf_token() }}"
          },
          success: function (response) {
            if (response.status === 1) {
              $('#btnCayegoryAdded').hide();
              $('#categoriesError').text('This Category is alreay stored or added');
            } else {
              console.log('not match');
            }

          },
          error: function (error) {
            console.error('Error:', error);
          }
        });


      });



















    })
  </script>

</body>

</html>