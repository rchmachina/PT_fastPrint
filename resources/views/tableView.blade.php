<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container-sm p-4">

        <h2 class="text-center">PT Fast Print</h2> 
        @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                format data tidak sesuai
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
<!-- Modal tambah data -->

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <form action="postBarang" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">No</label>
                            <input type="text" name="noProduk" id="noProduk" class="form-control" placeholder="masukan no produk">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama produk</label>
                            <input type="text" name="nameProduk" id="namaProduk" class="form-control" placeholder="masukan nama produk">
                        </div>
                        <div class="form-group">
                            <label for="harga">harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" placeholder="masukan harga">
                        </div>
                        <div class="form-group">
                            <label for="kategori">kategori</label>
                            <input type="text" name="kategori" id="kategori" class="form-control" placeholder="masukan kategori">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="kategori">barang tersedia/bisa dijual?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="bisa dijual" name="ketersediaan" id="ketersediaan1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        bisa dijual
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="tidak bisa dijual" name="ketersediaan" id="ketersediaan2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        tidak bisa dijual
                                    </label>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">buat data barang baru</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">
                <div class="d-flex justify-content-between">
                    <h2>list barang yang tersedia</h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    tambah barang
                    </button>
                </div>
                
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="row justify-content-center">
                    <div class="col-11">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                <td scope="col">NO</td>
                                <td scope="col">nama produk </td>
                                <td scope="col">kategori</td>
                                <td scope="col">harga </td>
                                <td scope="col">action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- foreach setiap data yang ada di database -->
                            @foreach ($barangAvaibles as $barangAvaible)
                                <tr>
                                    <td >{{$barangAvaible->no}}</td>
                                    <td >{{$barangAvaible->nama_produk}}</td>
                                    <td >{{$barangAvaible->kategori}}</td>
                                    <td >{{$barangAvaible->harga}}</td>
                                    <td >
                                        <div class="d-inline-flex p-2">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $barangAvaible->id_produk }}">Delete</button> &nbsp;
                                            <!-- delete data  -->
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateModal{{ $barangAvaible->id_produk }}" class="btn btn-warning">update</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- modal untuk menghapus data -->
                                <div class="modal fade" id="deleteModal{{ $barangAvaible->id_produk }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $barangAvaible->id_produk }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $barangAvaible->id_produk }}">hapus barang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                           <div class="modal-body">
                                                <p>apakah anda yakin ingin menghapus barang ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <a class="btn btn-danger" href="/deleteBarang/{{$barangAvaible->id_produk}}" role="button">delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- modal untuk menghapus data  -->
                                
                                <div class="modal fade" id="updateModal{{ $barangAvaible->id_produk }}" tabindex="-1" aria-labelledby="updateModal{{ $barangAvaible->id_produk }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateModal{{ $barangAvaible->id_produk }}">edit barang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                           <div class="modal-body">
                                                <form action="updateBarang/" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $barangAvaible->id_produk  }}">
                                                    <div class="form-group">
                                                        <label for="name">No</label>
                                                        <input type="text" name="noProduk" id="noProduk" class="form-control" placeholder="masukan no produk">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Nama produk</label>
                                                        <input type="text" name="nameProduk" id="namaProduk" class="form-control" placeholder="masukan nama produk">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga">harga</label>
                                                        <input type="number" name="harga" id="harga" class="form-control" placeholder="masukan harga">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kategori">kategori</label>
                                                        <input type="text" name="kategori" id="kategori" class="form-control" placeholder="masukan kategori">
                                                    </div>
                                                    <br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">update barang</button>

                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $barangAvaibles->links() }}
                <br>
                <br>
            </div>
        </div>
    </div>

    

    <script>
        setTimeout(function() {
            $(".alert").alert('close');
        }, 5000); // Change the timeout value (in milliseconds) according to your needs
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html> 