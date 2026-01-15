<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "data pelari";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// ================= PROSES SIMPAN KONTAK =================
$alert = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    $query = "INSERT INTO contact_messages (nama, email, pesan)
              VALUES ('$nama', '$email', '$pesan')";

            if (mysqli_query($conn, $query)) {
              $alert = "<div class='alert alert-success'>Pesan berhasil dikirim!</div>";
    }       else {
              $alert = "<div class='alert alert-danger'>Gagal mengirim pesan!</div>";
  }
}

// ================= DATA CHART =================
$chart_labels = [];
$chart_data   = [];

$chartQuery = mysqli_query($conn, "SELECT kota, jumlah_event FROM trail_events");

while ($row = mysqli_fetch_assoc($chartQuery)) {
    $chart_labels[] = $row['kota'];
    $chart_data[]   = $row['jumlah_event'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTCSolo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid d-flex justify-content-between align-items-center px-3">
    <a class="navbar-brand d-flex align-items-center" href="#hero">
      <img src="image/logo trail.png" alt="Logo TrailRunID" width="40" height="40" class="me-2">Bengawan Trail Crew
    </a>
    <ul class="navbar-nav d-flex flex-row">
      <li class="nav-item mx-2"><a class="nav-link active" href="#hero">Home</a></li>
      <li class="nav-item mx-2"><a class="nav-link" href="#events">Event Trail Run</a></li>
      <li class="nav-item mx-2"><a class="nav-link" href="#tips">Tips & Trik</a></li>
      <li class="nav-item mx-2"><a class="nav-link" href="#contact">Kontak</a></li>
    </ul>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- Hero Section -->
<header id="hero" class="hero">

  <video autoplay muted loop playsinline>
      <source src="image/Desain tanpa judul.mp4" type="video/mp4">
  </video>

  <div class="hero-content container text-center">
      <h1 class="display-3 fw-bold">Trail Runner Community</h1>
      <p>Based in Surakarta</p>
      <a href="#events" class="btn btn-warning btn-lg mt-3">Mulai Jelajah</a>
  </div>

</header>

<section id="about" class="about-section py-5">
  <div class="container" data-aos="fade-up">
    
    <h2 class="about-title text-center mb-3">
      Tentang <span>Bengawan Trail Crew</span>
    </h2>

    <p class="about-desc text-center mx-auto mb-5">
      Bengawan Trail Crew adalah wadah bagi pelari trail di Surakarta untuk berbagi semangat,
      menjelajah alam, dan mengembangkan komunitas trail run di berbagai daerah Indonesia.
    </p>

    <div class="row g-4 justify-content-center">
      <div class="col-md-4">
        <div class="about-card">
          <i class="bi bi-tree-fill"></i>
          <h5>Eksplorasi Alam</h5>
          <p>Menikmati jalur alam dengan tetap menjaga kelestariannya.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="about-card">
          <i class="bi bi-people-fill"></i>
          <h5>Komunitas</h5>
          <p>Membangun kebersamaan antar pelari trail di seluruh Indonesia terutama di Surakarta.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="about-card">
          <i class="bi bi-flag-fill"></i>
          <h5>Event Berkualitas</h5>
          <p>Mendukung dan mempromosikan event trail run lokal hingga nasional.</p>
        </div>
      </div>
    </div>

  </div>
</section>


<section id="about" class="py-5 bg-dark text-white"> <div class="container">
    <h2 class="text-center mb-4">Tentang Trail Run Indonesia</h2>
    <p class="text-center mb-5">
      Data partisipasi dan perkembangan komunitas trail run di Indonesia.
    </p>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <canvas id="trailChart"></canvas>
      </div>
    </div>
  </div>
</section>

<!-- Event Trail Run Section -->
<section id="events" class="py-5 bg-dark text-light">
  <div class="container">
    <h2 class="text-center mb-5">Event Trail Run Terpopuler</h2>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-right">
        <a href="https://siksorogo.id/"
        target="_blank"
        class="text-decoration-none text-light">
        
        <div class="card h-100">
          <img src="image/Siksorogo-Lawu-Ultra.jpg" class="card-img-top" alt="Siksorogo Ring of Lawu">
          <div class="card-body">
            <h5>Siksorogo Ring of Lawu</h5>
            <p>Rute menantang di Gunung Lawu, Solo, menyusuri hutan dan perbukitan dengan panorama alam yang indah.</p>
          </div>
        </div>
        </a>
      </div>
      <div class="col-md-4" data-aos="fade-down">
        <a href="https://fonesport.id/bts100"
        taget="_blank"
        class="text-decoration-none text-light">

        <div class="card h-100">
          <img src="image/bts-100.jpg" class="card-img-top" alt="Bromo Tengger Semeru 100">
          <div class="card-body">
            <h5>Bromo Tengger Semeru 100 (BTS100)</h5>
            <p>Ultra trail di area gunung Bromo-Tengger-Semeru, menantang dengan trek panjang dan pemandangan vulkanik.</p>
          </div>
        </div>
        </a>
      </div>
      <div class="col-md-4" data-aos="fade-left">
        <a href="https://mantra116.id/"
        taget="_blank"
        class="text-decoration-none text-light">

        <div class="card h-100">
          <img src="image/mantra116.jpg" class="card-img-top" alt="Mantra116">
          <div class="card-body">
            <h5>Mantra116</h5>
            <p>Event trail ekstrem di Jawa Timur, melalui jalur hutan dan pantai, menantang daya tahan peserta.</p>
          </div>
        </div>
        </a>
      </div>
      <div class="col-md-4" data-aos="fade-right">
        <a href="https://balitrailrunning.com/"
        taget="_blank"
        class="text-decoration-none text-light">

        <div class="card h-100">
          <img src="image/btr-ultra.jpg" class="card-img-top" alt="BTR Ultra Bali">
          <div class="card-body">
            <h5>BTR Ultra Bali</h5>
            <p>Trail ultra dengan rute menantang di pegunungan Bali, menghadirkan pemandangan alam yang spektakuler.</p>
          </div>
        </div>
        </a>
      </div>
      <div class="col-md-4" data-aos="fade-up">
        <a href="https://ctcultra.com/"
        taget="_blank"
        class="text-decoration-none text-light">

        <div class="card h-100">
          <img src="image/ctc-ultra.jpg" class="card-img-top" alt="Coast to Coast Night Ultra">
          <div class="card-body">
            <h5>Coast to Coast Night Ultra</h5>
            <p>Event ultra malam hari melintasi pantai dan bukit, menuntut ketahanan fisik dan mental peserta.</p>
          </div>
        </div>
        </a>
      </div>
      <div class="col-md-4" data-aos="fade-left">
        <a href="https://merbabu-skyrace.com/"
        taget="_blank"
        class="text-decoration-none text-light">

        <div class="card h-100">
          <img src="image/tirta-sky-race.jpg" class="card-img-top" alt="Merbabu Sky Race">
          <div class="card-body">
            <h5>Merbabu Sky Race</h5>
            <p>Trail race menantang di Gunung Merbabu, dengan jalur pegunungan dan hutan yang memacu adrenalin.</p>
          </div>
        </div>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Tips & Trik -->
<section id="tips" class="py-5 bg-dark text-light">
  <div class="container">
    <h2 class="text-center mb-5">Tips & Trik Trail Run</h2>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-right">
        <div class="card p-3 h-100 text-center shadow-sm rounded">
          <i class="bi bi-heart-pulse-fill fs-1 mb-3 text-warning"></i>
          <h5>Persiapkan Fisik</h5>
          <p>Lakukan latihan kardio, kekuatan, dan endurance sebelum lomba.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up">
        <div class="card p-3 h-100 text-center shadow-sm rounded">
          <i class="bi bi-bag fs-1 mb-3 text-warning"></i>
          <h5>Bawa Peralatan Lengkap</h5>
          <p>Sepatu trail, hydration pack, dan pakaian nyaman sesuai cuaca.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-left">
        <div class="card p-3 h-100 text-center shadow-sm rounded">
          <i class="bi bi-map fs-1 mb-3 text-warning"></i>
          <h5>Kenali Trek</h5>
          <p>Pelajari profil jalur, tanjakan, dan kondisi medan sebelum event.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Contact -->
<section id="contact" class="py-5 bg-dark text-light">
  <div class="container">
    <h2 class="text-center mb-4">Kontak Kami</h2>
    <p class="text-center mb-5">Tinggalkan pesan atau pertanyaan Anda:</p>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="contact-card p-4 shadow-sm rounded">
          <form method="POST" action="#contact">
            <input type="text" name="nama" class="form-control mb-3" placeholder="Nama Anda" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email Anda" required>
            <textarea name="pesan" class="form-control mb-3" rows="5" placeholder="Tulis pesan Anda" required></textarea>
            <button type="submit" class="btn btn-warning w-100 btn-submit">Kirim Pesan</button>
             <?php if ($alert): ?>
              <div class="alert alert-warning text-center">
              <?= $alert ?>
              </div>
             <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="footer py-4 bg-black">
  <div class="container">
    <div class="footer-icons-center">
      <a href="https://wa.me/6281234567890" target="_blank" aria-label="WhatsApp">
        <i class="bi bi-whatsapp"></i>
      </a>
      <a href="BTCSolo@gmail.com" aria-label="Email">
        <i class="bi bi-envelope-fill"></i>
      </a>
      <a href="https://instagram.com/bengawantrailcrew" target="_blank" aria-label="Instagram">
        <i class="bi bi-instagram"></i>
      </a>
    </div>
  </div>
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll("section, header");
    const navLinks = document.querySelectorAll(".nav-link");
  
    const observerOptions = {
      root: null,
      threshold: 0.6
    };
  
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          navLinks.forEach(link => link.classList.remove("active"));
  
          const activeLink = document.querySelector(
            `.nav-link[href="#${entry.target.id}"]`
          );
          if (activeLink) activeLink.classList.add("active");
        }
      });
    }, observerOptions);
  
    sections.forEach(section => observer.observe(section));
  });
  </script>
<script>
  document.querySelectorAll('.nav-link, .btn').forEach(link => {
    link.addEventListener('click', e => {
      const targetId = link.getAttribute('href');
      if (targetId.startsWith('#')) {
        e.preventDefault();
        const target = document.querySelector(targetId);
        const navbarHeight = document.querySelector('.navbar').offsetHeight;
  
        window.scrollTo({
          top: target.offsetTop - navbarHeight,
          behavior: 'smooth'
        });
      }
    });
  });
  </script>
  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('trailChart');

  const chartLabels = <?= json_encode($chart_labels); ?>;
  const chartData   = <?= json_encode($chart_data); ?>;

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: chartLabels,
      datasets: [{
        label: 'Jumlah Event Trail Run',
        data: chartData,
        backgroundColor: 'rgba(255, 152, 0, 0.7)'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          labels: { color: '#fff' }
        }
      },
      scales: {
        x: {
          ticks: { color: '#ccc' },
          grid: { color: 'rgba(255,255,255,0.1)' }
        },
        y: {
          beginAtZero: true,
          ticks: { color: '#ccc' },
          grid: { color: 'rgba(255,255,255,0.1)' }
        }
      }
    }
  });
</script>
  
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
      once: true
    });
  </script>
  

</body>
</html>

