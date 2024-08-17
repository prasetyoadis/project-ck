<style>
  nav{
    opacity: 0.7;
    background-color:	#FFF5EE;
  }
</style>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/">CeritaKita</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ ($title === "About") ? 'active' : '' }}" href="/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Help") ? 'active' : '' }}" href="/help">Help</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Katalog") ? 'active' : '' }}" href="/katalog">Katalog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Blog") ? 'active' : '' }}" href="/blog">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Testimoni") ? 'active' : '' }}" href="/testimoni">Testimoni</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>