@extends('layouts.app')

@section('name')
    Store Cart Page
@endsection

@section('content')
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="div col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Cart
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name &amp; Seller</th>
                                    <th>Price</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td style="width:20%">
                                            @if ($cart->product->galleries)
                                                <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}" alt="" class="w-75 cart-image" srcset="">
                                            @endif
                                        </td>
                                        <td style="width: 35%">
                                            <div class="product-title">{{ $cart->product->name }}</div>
                                            <div class="product-subtitle">by {{ $cart->user->store_name }}</div>
                                        </td>
                                        <td style="width: 35%">
                                            <div class="product-title">${{ number_format($cart->product->price) }}</div>
                                            <div class="product-subtitle">USD</div>
                                        </td>
                                        <td style="width: 20%">
                                            <form action="{{ route('cart-delete', $cart->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-remove-cart">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $totalPrice += $cart->product->price
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 mb-2">
                        <h2>Shipping Details</h2>
                    </div>
                </div>
                <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data" id="locations">
                    @csrf
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_one">Address 1</label>
                                <input type="text" class="form-control" id="address_one" name="address_one"
                                    value="Setra Duta Cemara">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_two">Address 2</label>
                                <input type="text" class="form-control" id="address_two" name="address_two"
                                    value="Setra Duta Cemara">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinces_id">Provice</label>
                                <select class="form-control" name="provinces_id" id="provinces_id" v-if="provinces" v-model="provinces_id">
                                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                </select>
                                <select name="" id="" class="form-control" v-else></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="regencies_id">City</label>
                                <select class="form-control" name="regencies_id" id="regencies_id" v-if="regencies" v-model="regencies_id">
                                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                                </select>
                                <select name="" id="" class="form-control" v-else></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip_code">Postal Code</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" value="30457">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="Indonesia">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Mobile </label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="+628 2020 11111">
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12 mb-1">
                            <h2>Payment Informations</h2>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-4 col-md-2">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Country Tax</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Product Insurance</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Ship to Jakarta</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title text-success">${{ number_format($totalPrice) ?? 0 }}</div>
                            <div class="product-subtitle">Total</div>
                        </div>
                        <div class="col-8 col-md-3">
                            <button type="submit" class="btn btn-success px-4 mt-3 btn-block">
                                Checkout Now
                            </button>
                        </div>
    
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var gallery = new Vue({
            el: "#locations",
            mounted() {
                AOS.init();
                this.getProvinceData();
            },
            data: {
                provinces: null,
                regencies: null,
                provinces_id: null,
                regencies_id: null
            },
            methods: {
                getProvinceData() {
                    let self = this;
                    axios.get('{{ route('api-provinces') }}')
                        .then(function(response){
                            self.provinces = response.data;
                        })
                },
                getRegenciesData() {
                    let self = this;
                    axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                        .then(function(response){
                            self.regencies = response.data;
                        })
                }
            },
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                }
            }
        })
    </script>
@endpush
