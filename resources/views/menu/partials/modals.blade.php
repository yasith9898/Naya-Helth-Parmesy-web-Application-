<!-- ===== Product Detail Modal ===== -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen m-0 product-detail-modal">
        <div class="modal-content product-modal-content">

            <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>

            <!-- Scrollable Image Section -->
            <div class="product-image-container">
                <div class="image-slide" id="product-modal-image">
                    <div class="modal-header header-title border-0">
                        <h5 class="modal-title text-white" id="productDetailModalLabel">Baklava Inn</h5>
                    </div>
                </div>

                <div class="modal-body product-details-section">
                    <div class="container-fluid p-0">
                        <h2 class="product-name-heading mb-3" id="product-modal-name">Product Name</h2>
                        <div class="options-container">
                            <h3 class="options-heading" data-translate="choose">Choose</h3>
                            <div id="product-options">
                                <!-- Options will be dynamically inserted here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ===== Category Modal ===== -->
<div class="modal modal-bottom" id="menuModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="height: 100%; max-width: 100%;">
        <div class="modal-content menu-modal rounded-4"
            style="margin-top: 50vh; background-color: #F0E7D8; position: absolute; bottom: 0;">
            <div class="modal-body pt-0 px-2 px-sm-3 pb-3 mt-4">
                <div class="menu-scroll">

                    <!-- Row 1 -->
                    <div class="row row-cols-3 g-3">
                        <div class="col">
                            <div class="card menu-card h-100" style="background-color: #F0E7D8;">
                                <img src="{{ asset('assetsnewpage/KUN.jpeg') }}" class="card-img-top" alt="Fıstık Zade">
                                <div class="card-body py-2 text-center">
                                    <p class="product-title mb-1" style="border-bottom: 1px solid rgba(0,0,0,.1);" data-translate="kunafa">Kunafa</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card menu-card h-100" style="background-color: #F0E7D8;">
                                <img src="{{ asset('assetsnewpage/KKBALAVAIN.jpeg') }}" class="card-img-top" alt="Special 1">
                                <div class="card-body py-2 text-center">
                                    <p class="product-title text-dark mb-1" style="border-bottom: 1px solid rgba(0,0,0,.1);" data-translate="katmer">Katmer</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card menu-card h-100" style="background-color: #F0E7D8;">
                                <img src="{{ asset('assetsnewpage/BSTTA.jpeg') }}" class="card-img-top" alt="Special 2">
                                <div class="card-body py-2 text-center">
                                    <p class="product-title text-dark mb-1" style="border-bottom: 1px solid rgba(0,0,0,.1);" data-translate="baklava">Baklava</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="row row-cols-3 g-3 mt-2">
                        <div class="col">
                            <div class="card menu-card h-100" style="background-color: #F0E7D8;">
                                <img src="{{ asset('assetsnewpage/Sweets.jpeg') }}" class="card-img-top" alt="Item 4">
                                <div class="card-body py-2 text-center">
                                    <p class="product-title text-dark mb-1" style="border-bottom: 1px solid rgba(0,0,0,.1);" data-translate="sweets">Sweets</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card menu-card h-100" style="background-color: #F0E7D8;">
                                <img src="{{ asset('assetsnewpage/CAK.jpeg') }}" class="card-img-top" alt="Item 5">
                                <div class="card-body py-2 text-center">
                                    <p class="product-title text-dark mb-1" style="border-bottom: 1px solid rgba(0,0,0,.1);" data-translate="cakes">Cakes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card menu-card h-100" style="background-color: #F0E7D8;">
                                <img src="{{ asset('assetsnewpage/Ice Cream.jpeg') }}" class="card-img-top" alt="Item 6">
                                <div class="card-body py-2 text-center">
                                    <p class="product-title text-dark mb-1" style="border-bottom: 1px solid rgba(0,0,0,.1);" data-translate="ice-cream">Ice Cream</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="row row-cols-3 g-3 mt-2">
                        <div class="col">
                            <div class="card menu-card h-100" style="background-color: #F0E7D8;">
                                <img src="{{ asset('assetsnewpage/BMOK.jpeg') }}" class="card-img-top" alt="Item 7">
                                <div class="card-body py-2 text-center">
                                    <p class="product-title text-dark mb-1" style="border-bottom: 1px solid rgba(0,0,0,.1);" data-translate="mocktails">Mocktails</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card menu-card h-100" style="background-color: #F0E7D8;">
                                <img src="{{ asset('assetsnewpage/FRJ.jpeg') }}" class="card-img-top" alt="Item 8">
                                <div class="card-body py-2 text-center">
                                    <p class="product-title text-dark mb-1" style="border-bottom: 1px solid rgba(0,0,0,.1);" data-translate="fresh-juice">Fresh Juice</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card menu-card h-100" style="background-color: #F0E7D8;">
                                <img src="{{ asset('assetsnewpage/BMOK.jpeg') }}" class="card-img-top" alt="Item 9">
                                <div class="card-body py-2 text-center">
                                    <p class="product-title text-dark mb-1" style="border-bottom: 1px solid rgba(0,0,0,.1);" data-translate="milkshakes">Milkshakes</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Last Row -->
                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-4">
                            <div class="card menu-card h-100" style="background-color: #F0E7D8;">
                                <img src="{{ asset('assetsnewpage/IFF.jpeg') }}" class="card-img-top" alt="Item 10">
                                <div class="card-body py-2 text-center">
                                    <p class="product-title text-dark mb-1" style="border-bottom: 1px solid rgba(0,0,0,.1);" data-translate="ice-coffee">Ice Coffee</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card menu-card h-100" style="background-color: #F0E7D8;">
                                <img src="{{ asset('assetsnewpage/EXHOT.jpeg') }}" class="card-img-top" alt="Item 11">
                                <div class="card-body py-2 text-center">
                                    <p class="product-title text-dark mb-1" style="border-bottom: 1px solid rgba(0,0,0,.1);" data-translate="hot-drinks">Hot Drinks</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- menu-scroll -->
            </div>
        </div>
    </div>
</div>
