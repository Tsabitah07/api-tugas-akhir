<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>{{$title}}</title>
    </head>
    <body>
        <div style="display: flex; justify-content: space-between; align-items: center;height: 100vh; text-align: center">
            <div style="width: 55%">
                <img src="https://img.freepik.com/premium-vector/patient-consultation-with-doctor-illustration_677179-56.jpg" alt="image" width="100%" height="100%" style="object-fit: fill">
            </div>
            <div style="background: #9F41EA; height: 100%; width: 40%; color: white; display: flex; flex-direction: column; justify-content: center; align-items: center">
                <h3>Welcome to RUSCare Admin</h3>
                <p >Only admin has access to this website</p>
                <form method="post" action="{{ route('login') }}" style="margin-top: 2vh; width: 55%; text-align: center;" >
                    @csrf
                    <div class="mb-2" style="text-align: left">
                        <label for="nis" class="form-label">NIS or Email</label>
                        <input type="text" class="form-control" id="nis" name="nis" placeholder="input nis or email" style="padding: 10px 15px">
                    </div>
                    <div class="mb-2" style="text-align: left">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="input password" style="padding: 10px 15px">
                    </div>
                    <button type="submit" class="btn" style="background: #F4C918; color: white; font-weight: bold; width: 100%; padding: 10px 0; margin-top: 3vh; ">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>
