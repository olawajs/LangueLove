@extends('layouts.app')
<style>
.accordion {
  max-width: 400px; /* Dostosuj szerokość accordiona do swoich potrzeb */
  margin: 20px auto; /* Ustawienie marginesu i centrowanie */
}

.accordion-item {
  border: 1px solid #ddd;
  margin-bottom: 10px;
}

.accordion-header {
  background-color: #f1f1f1;
  padding: 10px;
  cursor: pointer;
}

.accordion-content {
  display: none;
  padding: 10px;
}
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet"> 

<link href="{{ asset('css/owlCarousel/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/owlCarousel/owl.theme.default.min.css') }}" rel="stylesheet">
@section('content')
<div class="container "><!-- desktop -->

<div class="accordion">
    <div class="accordion-item">
      <div class="accordion-header">Pytanie 1</div>
      <div class="accordion-content">
        <p>Odpowiedź na pytanie 1.</p>
      </div>
    </div>

    <div class="accordion-item">
      <div class="accordion-header">Pytanie 2</div>
      <div class="accordion-content">
        <p>Odpowiedź na pytanie 2.</p>
      </div>
    </div>

    <!-- Dodaj więcej takich elementów, jeśli potrzebujesz -->

  </div>

</div>

<!-- wersja mobile
<div class="container mobile">

</div> -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{ asset('js/owlCarousel/owl.carousel.min.js') }}" defer></script>

<script>
     
     document.addEventListener('DOMContentLoaded', function () {
  const accordionItems = document.querySelectorAll('.accordion-item');

  accordionItems.forEach(function (item) {
    const header = item.querySelector('.accordion-header');
    const content = item.querySelector('.accordion-content');

    header.addEventListener('click', function () {
      // Toggle the display property of the content div
      content.style.display = (content.style.display === 'none' || content.style.display === '') ? 'block' : 'none';
    });
  });
});

</script>