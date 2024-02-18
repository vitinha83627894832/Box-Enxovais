<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../css/adm.css" />

    <!-- BoxIcons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>

  <body>
    <div class="sidebar">
      <div class="logo-details">
        <i class="bx bxs-cat"></i>
        <span class="logo_name">Box Enxovais</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="#">
            <i class="bx bx-grid-alt"></i>
            <span class="link_name">Dashboard</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Category</a></li>
          </ul>
        </li>
        <li>
          <div class="icon-links">
            <a href="#">
              <i class="bx bx-collection"></i>
              <span class="link_name">Category</span>
            </a>
            <i class="bx bx-chevron-down arrow"></i>
          </div>
          <ul class="sub-menu">
            <li><a class="link_name" href="#">Category</a></li>
            <li><a href="#">HTML & CSS</a></li>
            <li><a href="#">JavaScript</a></li>
            <li><a href="#">PHP & MySQL</a></li>
          </ul>
        </li>
        <li>
          <div class="icon-links">
            <a href="#">
              <i class="bx bx-book-alt"></i>
              <span class="link_name">Posts</span>
            </a>
            <i class="bx bx-chevron-down arrow"></i>
          </div>
          <ul class="sub-menu">
            <li><a class="link_name" href="#">Posts</a></li>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Card Design</a></li>
            <li><a href="#">Login Form</a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-pie-chart-alt-2"></i>
            <span class="link_name">Analytics</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Analytics</a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-line-chart"></i>
            <span class="link_name">Chart</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Chart</a></li>
          </ul>
        </li>
        <li>
          <div class="icon-links">
            <a href="#">
              <i class="bx bx-plug"></i>
              <span class="link_name">Plugins</span>
            </a>
            <i class="bx bx-chevron-down arrow"></i>
          </div>
          <ul class="sub-menu">
            <li><a class="link_name" href="#">Posts</a></li>
            <li><a href="#">UI Face</a></li>
            <li><a href="#">Pigments</a></li>
            <li><a href="#">Box Icons</a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-compass"></i>
            <span class="link_name">Explore</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Explorer</a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-history"></i>
            <span class="link_name">History</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Hisrory</a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-cog"></i>
            <span class="link_name">Settings</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Settings</a></li>
          </ul>
        </li>

        <li>
          <div class="profile-details">
            <div class="profile-content">
              <img src="../img/pandinha.jpg" alt="profile" />
            </div>

            <div class="name-job">
              <div class="profile_name">Prem Shahi</div>
              <div class="job">Web Designer</div>
            </div>
            <i class="bx bx-log-out"></i>
          </div>
        </li>
      </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Drop Dow Sidebar</span>
        </div>
    </section>

    <script>
      let arrow = document.querySelectorAll(".arrow");
      for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
          let arrowParent = e.target.parentElement.parentElement;

          arrowParent.classList.toggle("showMenu");
        });
      }

      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".bx-menu");
      console.log(sidebarBtn);
      sidebarBtn.addEventListener("click", ()=> {
        sidebar.classList.toggle("close");
      });
    </script>

    
  </body>
</html>
