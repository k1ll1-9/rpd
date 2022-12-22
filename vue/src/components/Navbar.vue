<template>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5 rounded">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link text-light dropdown-toggle"
               href="#"
               id="lists"
               data-bs-toggle="dropdown"
            >
              Список
            </a>
            <ul class="dropdown-menu" aria-labelledby="lists">
              <router-link
                v-if="$route.path !== '/' && $route.path !== '/plans'"
                to="/"
                class="dropdown-item"
              >
                Учебных планов
              </router-link>
              <router-link
                v-if="$route.path !== '/kafs'"
                to="/kafs"
                class="dropdown-item"
              >
                Кафедр
              </router-link>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link text-light dropdown-toggle"
               href="#" id="stats"
               data-bs-toggle="dropdown"
            >
              Статистика
            </a>
            <ul class="dropdown-menu" aria-labelledby="stats">
              <router-link
                v-if="$route.fullPath !== '/stat?type=plans'"
                to="/stat?type=plans"
                class="dropdown-item"
              >
                По учебным планам
              </router-link>
              <router-link
                v-if="$route.fullPath !== '/stat?type=kafs'"
                to="/stat?type=kafs"
                class="dropdown-item"
              >
                По кафедрам
              </router-link>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="https://lk.vavt.ru/doc/rpd/">Активные согласования</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>

export default {
  name: "Navbar",
  data() {
    return {}
  },
  computed: {},
  mounted() {
    document.querySelectorAll('.dropdown-toggle')
      .forEach((el) => {
        el.addEventListener('click', function () {

          const dropdowns = document.getElementsByClassName("dropdown-menu");

          dropdowns.forEach((el) => {

            if (el.style.display === 'block') {
              el.style.display = 'none'
            }

          })

          const subMenu = this.nextSibling

          if (subMenu.style.display === 'none' || subMenu.style.display === '') {
            subMenu.style.display = 'block'
          } else {
            subMenu.style.display = 'none'
          }

        })
      })

    document.onclick = function (e) {
      if (!e.target.matches('.dropdown-toggle')) {

        const dropdowns = document.getElementsByClassName("dropdown-menu");

        dropdowns.forEach((el) => {

          if (el.style.display === 'block') {
            el.style.display = 'none'
          }

        })

      }
    }
  },
  updated() {
    console.log(this.$route)
  }
}
</script>

<style scoped>

</style>
