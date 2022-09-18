@extends('layouts.main')

@section('style')
<link rel="stylesheet" href="js/plugins/select2/css/select2.min.css">
@endsection

@section('content')
<div class="content">
  <!-- Header -->
  <div class="block block-rounded bg-gd-dusk">
    <div class="block-content bg-white-op-5">
      <div class="py-30 text-center">
        <h1 class="font-w700 text-white mb-10">ACCUEIL</h1>
        <h2 class="h4 font-w400 text-white-op">Bienvenue, à fruiticapp !</h2>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <!-- Icon Navigation -->
  <div class="row gutters-tiny push">
    <div class="col-6 col-md-4 col-xl-2">
      <a class="block block-rounded block-bordered block-link-shadow text-center" href="/stock">
        <div class="block-content">
          <p class="mt-5">
            <i class="si si-basket-loaded fa-3x text-muted"></i>
          </p>
          <p class="font-w600">Stocks</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
      <a class="block block-rounded block-bordered block-link-shadow ribbon ribbon-primary text-center" href="/vente">
        <!-- <div class="ribbon-box">5</div> -->
        <div class="block-content">
          <p class="mt-5">
            <i class="fa fa-cart-plus fa-3x text-muted"></i>
          </p>
          <p class="font-w600">Ventes</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
      <a class="block block-rounded block-bordered block-link-shadow text-center" href="/approvisionnement">
        <div class="block-content">
          <p class="mt-5">
            <i class="fa fa-cart-plus fa-3x text-muted"></i>
          </p>
          <p class="font-w600">Approvisionnments</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
      <a class="block block-rounded block-bordered block-link-shadow text-center" href="/client">
        <div class="block-content">
          <p class="mt-5">
            <i class="si si-bar-chart fa-3x text-muted"></i>
          </p>
          <p class="font-w600">Client</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
      <a class="block block-rounded block-bordered block-link-shadow ribbon ribbon-primary text-center" href="/produit">
        <!-- <div class="ribbon-box">3</div> -->
        <div class="block-content">
          <p class="mt-5">
            <i class="fa fa-wpforms fa-3x text-muted"></i>
          </p>
          <p class="font-w600">Produits</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
      <a class="block block-rounded block-bordered block-link-shadow text-center" href="/autre">
        <div class="block-content">
          <p class="mt-5">
            <i class="si si-docs fa-3x text-muted"></i>
          </p>
          <p class="font-w600">Autres</p>
        </div>
      </a>
    </div>
  </div>
</div>
@section('script')

@endsection

@endsection
