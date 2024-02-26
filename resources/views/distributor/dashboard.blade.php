@extends('distributor.dashboard_layouts.main')

@section('content')
    <div class="main-content">
        <section class="section mt-4 p-4">
            <div class="section-header">
                <h2 class="section-title">Product List</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    @foreach ($products as $item)
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                            <article class="article">
                                <div class="article-header">
                                    <div class="article-image" style="background-image: url('{{ $item->link_images }}');">
                                    </div>
                                    <div class="article-title">
                                        <h2><a href="#">{{ $item->OfferPetani->name_product }}</a></h2>
                                    </div>
                                </div>
                                <div class="article-details">
                                    <p>Quantity : {{ $item->OfferPetani->quantity }}</p>
                                    <p>Price : {{ $item->OfferPetani->price_start_sell }}</p>
                                    <div class="article-cta">
                                        <button class="btn btn-primary tawar-btn" data-toggle="modal"
                                            data-user="{{ Auth::user()->id }}" data-target="#form-tawar"
                                            data-name="{{ $item->OfferPetani->name_product }}"
                                            data-productId="{{$item->OfferPetani->id}}"
                                            data-quantity="{{ $item->OfferPetani->quantity }}"
                                            data-price="{{ $item->OfferPetani->price_start_sell }}">Tawar</button>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="form-tawar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tawar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="offerForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="product-name">Product Name:</label>
                            <input type="text" class="form-control" id="product-name" name="product_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="product-quantity">Quantity:</label>
                            <input type="number" class="form-control" id="product-quantity" name="product_quantity">
                        </div>
                        <div class="form-group">
                            <label for="product-original-price">Original Price:</label>
                            <input type="text" class="form-control" id="product-original-price"
                                name="product_original_price" readonly>
                        </div>
                        <div class="form-group">
                            <label for="offer-price">Offer Price:</label>
                            <input type="text" class="form-control" id="offer-price" name="offer_price">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let user_id;
            let product_id;
            $('.tawar-btn').click(function() {
                let productName = $(this).data('name');
                let productQuantity = $(this).data('quantity');
                let productPrice = $(this).data('price');
                let user_id = $(this).data('user');
                let product_id = $(this).data('product_id');

                $('#product-name').val(productName);
                $('#product-quantity').val(productQuantity);
                $('#product-original-price').val(productPrice);
                $('#offer-price').val(''); // Clear the offer price field every time the modal is opened
            });

            $('#offerForm').submit(function(e) {
                e.preventDefault();

                var formData = {
                    user_id: String(user_id),
                    quantity: $('#product-quantity').val(),
                    price_submitted: $('#offer-price').val(),
                    id_penawaran: String(product_id)
                };

                $.ajax({
                    type: 'POST',
                    url: '/api/negotiations-post',
                    data: JSON.stringify(formData),
                    contentType: "application/json",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        alert('Negotiation submitted successfully!');
                        $('#form-tawar').modal('hide');
                    },
                    error: function(error) {
                        console.log('Error:', error);
                        alert('Failed to submit negotiation.');
                    }
                });
            });
        });
    </script>
@endsection
