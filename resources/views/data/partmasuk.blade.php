@extends('layouts.app')

@section('header')
    <h2 class="text-3xl font-semibold text-gray-800">
        {{ __('Form Input') }}
    </h2>
@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h1>Input Part Masuk</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('partmasuk.store') }}" method="POST" id="dataForm" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ref_pp" class="form-label">Referensi PR</label>
                                <input type="text" class="form-control @error('ref_pp') is-invalid @enderror" id="ref_pp" name="ref_pp" value="{{ old('ref_pp') }}">
                                @error('ref_pp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                                <div class ="search-point" id="search_results_pp"></div>
                                <div class="form-actions"></div>

                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                                <div class ="search-point" id="search_results"></div>
                                <div class="form-actions"></div>

                            <div class="mb-3">
                                <label for="kode_barang" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" readonly>
                                @error('kode_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" value="{{ old('qty') }}">
                                @error('qty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-actions">
                                <button type="button" onclick="resetForm()" class="btn btn-outline-danger">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <div id="toast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 10px; right: 10px; display: none;">
                            <div class="d-flex">
                                <div class="toast-body" id="toastMessage"></div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-actions {
        display: flex;
        justify-content: space-between; 
        margin-top: 20px; 
    }
    .search-point {
        position: absolute; 
        z-index: 1000; 
        background: white; 
        width: 96.5%; 
        max-height: 230px;
        overflow-y: hidden;
        overflow-x: hidden;
    }

    .search-point:hover {
        overflow-y: auto;
    }
</style>

<script>
    function resetForm() {
        var form = document.getElementById('dataForm');
        form.reset();
    }
</script>

<script>
document.getElementById('nama_barang').addEventListener('input', function() {
    var namaBarang = this.value;
    var searchResults = document.getElementById('search_results');
    
    if (namaBarang.length >= 2) {
        fetch(`/data/search-nama-barang/${encodeURIComponent(namaBarang)}`)
            .then(response => response.json())
            .then(data => {
                searchResults.innerHTML = '';
                if (data.length > 0) {
                    var list = document.createElement('ul');
                    list.classList.add('list-group');
                    data.forEach(item => {
                        var listItem = document.createElement('li');
                        listItem.classList.add('list-group-item');
                        listItem.textContent = `${item.nama_barang} - ${item.kode_barang}`; 
                        listItem.dataset.nama = item.nama_barang;
                        listItem.dataset.kode = item.kode_barang;
                        listItem.addEventListener('click', function() {
                            document.getElementById('nama_barang').value = item.nama_barang;
                            document.getElementById('kode_barang').value = item.kode_barang;
                            searchResults.innerHTML = '';
                        });
                        list.appendChild(listItem);
                    });
                    searchResults.appendChild(list);
                } else {
                    searchResults.innerHTML = '<p>No results found.</p>';
                }
            })
            .catch(error => console.error('Error:', error));
    } else {
        searchResults.innerHTML = '';
    }
});
</script>

<script>
document.getElementById('ref_pp').addEventListener('input', function() {
    var noPurchase = this.value;
    var searchResults = document.getElementById('search_results_pp');
    
    if (noPurchase.length >= 2) {
        fetch(`/data/search-no-purchase/${encodeURIComponent(noPurchase)}`)
            .then(response => response.json())
            .then(data => {
                searchResults.innerHTML = '';
                if (data.length > 0) {
                    var list = document.createElement('ul');
                    list.classList.add('list-group');
                    data.forEach(item => {
                        var listItem = document.createElement('li');
                        listItem.classList.add('list-group-item');
                        listItem.textContent = `${item.ref_pp}`; 
                        listItem.dataset.nama = item.ref_pp;
                        listItem.addEventListener('click', function() {
                            document.getElementById('ref_pp').value = item.ref_pp;
                            searchResults.innerHTML = '';
                        });
                        list.appendChild(listItem);
                    });
                    searchResults.appendChild(list);
                } else {
                    searchResults.innerHTML = '<p>No results found.</p>';
                }
            })
            .catch(error => console.error('Error:', error));
    } else {
        searchResults.innerHTML = '';
    }
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                showConfirmButton: true,
                timer: 4000 
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                showConfirmButton: true,
                timer: 4000 
            });
        @endif
    });
</script>


@endsection
