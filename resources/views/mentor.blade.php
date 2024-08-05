@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div div style="width: 78vw; height: 9vh; display: flex; flex-direction: row; padding: 15px 10px 0 15px; justify-content: space-between; align-items: center">
            <div>
                <p>Mentor List</p>
                <div>
                    <p></p>
                </div>
            </div>
            <form style="display: flex; flex-direction: row; gap: 5px">
                <input type="search" placeholder="Search" aria-label="Search" style="height: 35px; width: 260px; border: 1px solid gray; border-radius: 7px; padding-left: 10px; margin: 0">
                <button type="submit" style="width: 35px; height: 35px; border: 1px solid gray; border-radius: 7px"></button>
            </form>
        </div>
{{--        <div style="padding: 10px 30px; max-height: 85vh;">--}}
{{--            <table class="table">--}}
{{--                <thead class="thead-light">--}}
{{--                <tr>--}}
{{--                    <th scope="col">#</th>--}}
{{--                    <th scope="col">First</th>--}}
{{--                    <th scope="col">Last</th>--}}
{{--                    <th scope="col">Action</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                <tr>--}}
{{--                    <th scope="row">1</th>--}}
{{--                    <td>Mark</td>--}}
{{--                    <td>Otto</td>--}}
{{--                    <td>--}}
{{--                        <button class="btn btn-outline-primary">Detail</button>--}}
{{--                        <button class="btn btn-outline-danger">Delete</button>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th scope="row">2</th>--}}
{{--                    <td>Jacob</td>--}}
{{--                    <td>Thornton</td>--}}
{{--                    <td>--}}
{{--                        <button class="btn btn-outline-primary">Detail</button>--}}
{{--                        <button class="btn btn-outline-danger">Delete</button>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th scope="row">3</th>--}}
{{--                    <td>Larry</td>--}}
{{--                    <td>the Bird</td>--}}
{{--                    <td>--}}
{{--                        <button class="btn btn-outline-primary">Detail</button>--}}
{{--                        <button class="btn btn-outline-danger">Delete</button>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
        <div style="display: flex; flex-direction: column; padding: 15px 25px 15px 15px; gap: 17px">
            <div style="display: flex; flex-direction: row; padding: 13px 19px 13px 19px; justify-content: space-between; border: #1a202c 1px solid; border-radius: 5px">
                <div style="width: 7.5vw; height: 10vw; background: bisque">Image</div>
                <div style="width: 55vw; height: 10vw; display: flex; flex-direction: column; justify-content: start;">
                    <h4 style="margin: 0; padding-bottom: 5px">Nama Lengkap</h4>
                    <div style="display: flex; flex-direction: column;">
                        <p style="background: white; margin: 0; padding: 0">Jurusan</p>
                        <p style="background: white; margin: 0; padding: 0">ttl / usia</p>
                    </div>

{{--                    <div style="background: #9F41EA; width: 115px; height: 35px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: white">See Detail</a></div>--}}
                </div>
                <div style="width: 9vw; display: flex; flex-direction: column; justify-content: space-between; gap: 7px; align-items: center">
                    <div style="display: flex; flex-direction: column; gap: 7px">
                        <div style="border: #9F41EA solid 1px; width: 125px; height: 30px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: #9F41EA; font-size: small; font-weight: bold">See Detail</a></div>
                        <div style="border: #9F41EA solid 1px; width: 125px; height: 30px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: #9F41EA; font-size: small; font-weight: bold">Edit Data</a></div>
                    </div>

                    <div style="background: #ef4444; width: 125px; height: 35px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: white; font-size: small; font-weight: bold">Delete Data</a></div>
                </div>
            </div>

            <div style="display: flex; flex-direction: row; padding: 13px 19px 13px 19px; justify-content: space-between; border: #1a202c 1px solid; border-radius: 5px">
                <div style="width: 7.5vw; height: 10vw; background: bisque">Image</div>
                <div style="width: 55vw; height: 10vw; display: flex; flex-direction: column; justify-content: start;">
                    <h4 style="margin: 0; padding-bottom: 5px">Nama Lengkap</h4>
                    <div style="display: flex; flex-direction: column;">
                        <p style="background: white; margin: 0; padding: 0">Jurusan</p>
                        <p style="background: white; margin: 0; padding: 0">ttl / usia</p>
                    </div>

                    {{--                    <div style="background: #9F41EA; width: 115px; height: 35px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: white">See Detail</a></div>--}}
                </div>
                <div style="width: 9vw; display: flex; flex-direction: column; justify-content: space-between; gap: 7px; align-items: center">
                    <div style="display: flex; flex-direction: column; gap: 7px">
                        <div style="border: #9F41EA solid 1px; width: 125px; height: 30px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: #9F41EA; font-size: small; font-weight: bold">See Detail</a></div>
                        <div style="border: #9F41EA solid 1px; width: 125px; height: 30px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: #9F41EA; font-size: small; font-weight: bold">Edit Data</a></div>
                    </div>

                    <div style="background: #ef4444; width: 125px; height: 35px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: white; font-size: small; font-weight: bold">Delete Data</a></div>
                </div>
            </div>

            <div style="display: flex; flex-direction: row; padding: 13px 19px 13px 19px; justify-content: space-between; border: #1a202c 1px solid; border-radius: 5px">
                <div style="width: 7.5vw; height: 10vw; background: bisque">Image</div>
                <div style="width: 55vw; height: 10vw; display: flex; flex-direction: column; justify-content: start;">
                    <h4 style="margin: 0; padding-bottom: 5px">Nama Lengkap</h4>
                    <div style="display: flex; flex-direction: column;">
                        <p style="background: white; margin: 0; padding: 0">Jurusan</p>
                        <p style="background: white; margin: 0; padding: 0">ttl / usia</p>
                    </div>

                    {{--                    <div style="background: #9F41EA; width: 115px; height: 35px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: white">See Detail</a></div>--}}
                </div>
                <div style="width: 9vw; display: flex; flex-direction: column; justify-content: space-between; gap: 7px; align-items: center">
                    <div style="display: flex; flex-direction: column; gap: 7px">
                        <div style="border: #9F41EA solid 1px; width: 125px; height: 30px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: #9F41EA; font-size: small; font-weight: bold">See Detail</a></div>
                        <div style="border: #9F41EA solid 1px; width: 125px; height: 30px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: #9F41EA; font-size: small; font-weight: bold">Edit Data</a></div>
                    </div>

                    <div style="background: #ef4444; width: 125px; height: 35px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: white; font-size: small; font-weight: bold">Delete Data</a></div>
                </div>
            </div>

            <div style="display: flex; flex-direction: row; padding: 13px 19px 13px 19px; justify-content: space-between; border: #1a202c 1px solid; border-radius: 5px">
                <div style="width: 7.5vw; height: 10vw; background: bisque">Image</div>
                <div style="width: 55vw; height: 10vw; display: flex; flex-direction: column; justify-content: start;">
                    <h4 style="margin: 0; padding-bottom: 5px">Nama Lengkap</h4>
                    <div style="display: flex; flex-direction: column;">
                        <p style="background: white; margin: 0; padding: 0">Jurusan</p>
                        <p style="background: white; margin: 0; padding: 0">ttl / usia</p>
                    </div>

                    {{--                    <div style="background: #9F41EA; width: 115px; height: 35px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: white">See Detail</a></div>--}}
                </div>
                <div style="width: 9vw; display: flex; flex-direction: column; justify-content: space-between; gap: 7px; align-items: center">
                    <div style="display: flex; flex-direction: column; gap: 7px">
                        <div style="border: #9F41EA solid 1px; width: 125px; height: 30px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: #9F41EA; font-size: small; font-weight: bold">See Detail</a></div>
                        <div style="border: #9F41EA solid 1px; width: 125px; height: 30px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: #9F41EA; font-size: small; font-weight: bold">Edit Data</a></div>
                    </div>

                    <div style="background: #ef4444; width: 125px; height: 35px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: white; font-size: small; font-weight: bold">Delete Data</a></div>
                </div>
            </div>

            <div style="display: flex; flex-direction: row; padding: 13px 19px 13px 19px; justify-content: space-between; border: #1a202c 1px solid; border-radius: 5px">
                <div style="width: 7.5vw; height: 10vw; background: bisque">Image</div>
                <div style="width: 55vw; height: 10vw; display: flex; flex-direction: column; justify-content: start;">
                    <h4 style="margin: 0; padding-bottom: 5px">Nama Lengkap</h4>
                    <div style="display: flex; flex-direction: column;">
                        <p style="background: white; margin: 0; padding: 0">Jurusan</p>
                        <p style="background: white; margin: 0; padding: 0">ttl / usia</p>
                    </div>

                    {{--                    <div style="background: #9F41EA; width: 115px; height: 35px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: white">See Detail</a></div>--}}
                </div>
                <div style="width: 9vw; display: flex; flex-direction: column; justify-content: space-between; gap: 7px; align-items: center">
                    <div style="display: flex; flex-direction: column; gap: 7px">
                        <div style="border: #9F41EA solid 1px; width: 125px; height: 30px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: #9F41EA; font-size: small; font-weight: bold">See Detail</a></div>
                        <div style="border: #9F41EA solid 1px; width: 125px; height: 30px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: #9F41EA; font-size: small; font-weight: bold">Edit Data</a></div>
                    </div>

                    <div style="background: #ef4444; width: 125px; height: 35px; border-radius: 5px; display: flex; justify-content: center; align-items: center"><a href="" style="text-decoration: none; color: white; font-size: small; font-weight: bold">Delete Data</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
