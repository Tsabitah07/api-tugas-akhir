@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div div style="width: 80vw; height: 7vh; display: flex; flex-direction: row; background: beige; padding: 10px 35px 0 15px; justify-content: space-between; align-items: center">
            <h4>Student</h4>
            <form style="display: flex; flex-direction: row; gap: 5px">
                <input type="search" placeholder="Search" aria-label="Search" style="height: 35px; width: 270px; border: 1px solid gray; border-radius: 7px; padding-left: 10px">
                <button type="submit" style="width: 35px; height: 35px; border: 1px solid gray; border-radius: 7px"></button>
            </form>
        </div>
        <div style="padding: 10px 30px; max-height: 85vh;">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>
                        <button class="btn btn-primary">Detail</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>
                        <button class="btn btn-primary">Detail</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>
                        <button class="btn btn-primary">Detail</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
