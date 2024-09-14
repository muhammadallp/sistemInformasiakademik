<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <title>SMPN 1 Sipora</title>
  </head>
  <body id="home">
    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">SMPN 1 Sipora</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">Sejarah Sekolah</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#projects">VIsi Misi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir -->
    <!-- jumb -->
    <section class="jumbotron text-center">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                  <img src="/img/smpn1.jpg" class="d-block w-100" alt="2">
            </div>
            <div class="carousel-item">
                  <img src="/img/abs.jpg" class="d-block w-100" alt="1">
              </div>
              <div class="carousel-item">
                <img src="/img/smpn1s.jpg" class="d-block w-100" alt="3">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </section>
    <!-- akhir -->

    <!-- about -->
    <section class="about" id="about">
      <div class="container">
        <div class="row text-center mt-5 mb-3">
          <div class="col">
            <h2>Sejarah Sekolah</h2>
          </div>
        </div>
        <div class="row justify-content-center fs-5 text-center">
          {{-- <div class="col-md-4">
            <p>I am a graduate of Universitas Putra Indonesia YPT Padang in 2022. I am very interested in the field of information technology.</p>
          </div>
          <div class="col-md-4">
            <p>Therefore, I am very happy to implement the experience and what I have learned. Being someone who is competent in information technology is one of my dreams.</p>
          </div>
        </div> --}}
        <p>SMPN 1 Sipora Selatan adalah satu dari tiga Sekolah Menengah Pertama yang ada di Sipora Selatan Kabupaten Kepulauan Mentawai, yang berdiri sejak tahun 1983 dan mulai beroperasi pada tahun 1984.  Saat ini SMPN 1 Sipora Selatan dipimpin oleh bapak Jonnover Aritonang, S.Pd sebagai kepala sekolah. Luas tanah SMPN 1 Sipora Selatan saat ini adalah 10.000 M².</p>
      </div>
      {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
          fill="#e2edff"
          fill-opacity="1"
          d="M0,96L48,80C96,64,192,32,288,42.7C384,53,480,107,576,122.7C672,139,768,117,864,128C960,139,1056,181,1152,176C1248,171,1344,117,1392,90.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
        ></path>
      </svg> --}}
    </section>
    <!-- akhir About -->

    <!-- projects -->
    <section id="projects">
      <div class="container">
        <div class="row text-center mb-3">
          <div class="col">
            <h2>VIsi Misi</h2>
          </div>
        </div>
        <div class="row">
           
            <b>
                VISI
                </b>
            <br>
            <p>
            "Unggul dalam Mutu, Bertakwa, Santun, Berbudaya dan Berwawasan Global"
            </p>
            
            <p>Visi ini merupakan cita-cita bersama dari warga sekolah dan segenap pihak yang berkepentingan pada masa yang akan datang. Adapun indikator ketercapaian visi tersebut sebagai berikut :
            </p>
            <p>a. Terwujudnya lulusan yang cerdas komprehensif, yaitu cerdas intelektual, cerdas emosional dan cerdas spiritual;</p>
            <p>
                b. Terlaksananya kegiatan pembelajaran yang efektif dan berdaya saing tinggi dengan berorientasi pada peserta didik;

            </p>
            <p>
                c. Terwujudnya lulusan yang cerdas, kompetitif dan memiliki jati diri Bangsa Indonesia;
            </p>
            <p>
                D. Tersedianya sumber daya pendidikan tenaga kependidikan yang profesional;
            </p>
            <p>
                E. Terwujudnya sistem pelayanan berbasis data
            </p>
            <p>
                F. Terwujudnya kemampuan untuk menghindarkan diri dari konflik yang disebabkan adanya keterbatasan dan perbedaan;
            </p>
            <p>
                G. Terwujudnya peserta didik yang berjiwa kreatif, mampu mengembangkan perolehan hasil Pendidikan bagi kepentingan hidupnya;
            </p>
            <p>
                H. Terbentuknya karakter peserta didik yang bertakwa, cakap dalam bertindak sesuai dengan norma-norma sosial yang bersumber dari nilai-nilai ajaran agama dan budaya;
            </p>
            <p>    
               I. Terbentuknya sikap hormat dan beradab dalam perilaku, santun dalam tutur kata, budi bahasa dan kelakuan yang baik sesuai dengan adat istiadat dan budaya setempat yang harus dilakukan;
            </p>
            <p>

                J. Terwujudnya warga sekolah yang berdisiplin tinggi, sopan, santun, dan peduli sesama;
            </p>
            <p>
                K. Terwujudnya warga sekolah yang menjunjung tinggi nilai-nilai luhur budaya bangsa;
            </p>
            <p>
                L. Terwujudnya kesadaran terhadap adanya saling ketergantungan dan perbedaan diantara masyarakat sebagai dasar untuk hidup bersama yang saling menghormati;
            </p>
            <p>

                M. Terwujudnya keteguhan sikap terhadap perubahan yang terus menerus dari waktu ke waktu;
            </p>
            <p>
                N. Terbentuknya sikap saling menghormati terhadap perbedaan kultur di antara masyarakat dunia atau kelompok-kelompok dalam masyarakat; 

            </p>
             
            <b>
                MISI
            </b>
            <p>
                Untuk mewujudkan visi SMPN 1 Sipora diperlukan suatu misi berupa kegiatan jangka panjang dengan arah yang jelas yang akan dicapai dalam kurun waktu tertentu. Misi tersebut memberikan arah dalam mewujudkan visi sesuai dengan tujuan pendidikan nasional. Misi ini akan menjadi dasar dari program pokok sekolah. Misi SMPN Negeri 1 Sipora adalah :
            </p>
            <p>
                1. Menumbuhkembangkan semangat keunggulan dan persaingan yang sehat dalam memperoleh prestasi terbaik kepada seluruh warga sekolah;
            </p>
            <p>
                2. Mendorong dan membantu setiap peserta didik untuk mengenali potensi dirinya, sehingga dapat berkembang secara optimal;
            </p>
            <p>
                3. Menumbuhkembangkan amalan agama sehingga menjadi landasan moral dalam kehidupan sehari-hari;
            </p>
            <p>
               4. Membentuk manusia berbudi pekerti luhur disiplin, cakap, kreatif, mandiri, sehat rohani dan jasmani yang mampu menghormati orang tua, guru dan sesama peserta didik serta lingkungannya;
            </p>
            <p>
                5. Menumbuhkembangkan budi pekerti, tata krama dalam pergaulan sehingga menjadi pribadi yang santun dan berdisiplin;
            </p>
            <p>
               6. Menyiapkan peserta didik sebagai calon ilmuwan yang berwawasan dan berbudaya;
            </p>
            <p>
               7. Mewujudkan proses pembelajaran yang berbasis IPTEK dengan menjunjung tinggi nilai IMTAQ;
            </p>
            <p>
            8. Membentuk peserta didik yang berwawasan luas dalam segala bidang melalui teknologi informasi dan komunikasi serta bahasa asing yang dikuasainya.

            </p>
      </div>
      {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
          fill="#fff"
          fill-opacity="1"
          d="M0,64L30,96C60,128,120,192,180,202.7C240,213,300,171,360,170.7C420,171,480,213,540,218.7C600,224,660,192,720,176C780,160,840,160,900,186.7C960,213,1020,267,1080,277.3C1140,288,1200,256,1260,224C1320,192,1380,160,1410,144L1440,128L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"
        ></path>
      </svg> --}}
    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,128L60,149.3C120,171,240,213,360,229.3C480,245,600,235,720,218.7C840,203,960,181,1080,181.3C1200,181,1320,203,1380,213.3L1440,224L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
    <footer style="background-color: #0099ff" class=" text-white text-center pb-3">
      <p>Created By <a href="https://www.instagram.com/muhammadallp/" class="text-decoration-none text-white fw-bold"> Sekolah Menengah Pertama Negeri 1 Sipora</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
      const scriptURL = "https://script.google.com/macros/s/AKfycbzNER-x4SO21Q-mnL2_Zq9qGC-3i2C6JxYeRRrvhzzU1UFpBQreEjTOP5RP_kTJxJZWKw/exec";
      const form = document.forms["submit-to-google-sheet"];
      const btnKirim = document.querySelector(".btn-kirim");
      const btnLoading = document.querySelector(".btn-loading");
      const myAlert = document.querySelector(".my-alert");

      form.addEventListener("submit", (e) => {
        e.preventDefault();
        // ketika submit di klik

        btnLoading.classList.toggle("d-none");
        btnKirim.classList.toggle("d-none");

        fetch(scriptURL, { method: "POST", body: new FormData(form) })
          .then((response) => {
            btnLoading.classList.toggle("d-none");
            btnKirim.classList.toggle("d-none");
            myAlert.classList.toggle("d-none");
            form.reset();

            console.log("Success!", response);
          })
          .catch((error) => console.error("Error!", error.message));
      });
    </script>
  </body>
</html>
