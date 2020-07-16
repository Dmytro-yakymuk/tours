<template>
  <div class="main-cn hotel-page bg-white clearfix">
    <div class="row">
      <!-- Hotel Right -->
      <div class="col-md-9 col-md-push-3">
        <!-- Breakcrumb -->
        <section class="breakcrumb-sc">
          <ul class="breadcrumb arrow">
            <li>
              <a :href="'/' + language_locale">
                <i class="fa fa-home"></i>
              </a>
            </li>
            <li>
              <a>{{ specie_name }}</a>
            </li>
          </ul>
        </section>

        <!-- End Breakcrumb -->
        <!-- Hotel List -->
        <section class="hotel-list">
          <!-- Sort by and View by -->
          <div class="sort-view clearfix">
            <!-- Sort by -->
            <div class="sort-by float-left">
              <label>Sort by:</label>

              <div class="view-by-sort float-right">
                <ul>
                  <li v-on:click="resortCafes('title')" class="float-left">
                    <span>Title</span>
                    <img
                      src="/images/sort/up-arrow.png"
                      v-show="sortBy == 'title' && sortDirection == 'ASC'"
                    >
                    <img
                      src="/images/sort/down-arrow.png"
                      v-show="sortBy == 'title' && sortDirection == 'DESC'"
                    >
                  </li>

                  <li v-on:click="resortCafes('price')" class="float-left view-by-sort-border">
                    <span>Price</span>
                    <img
                      src="/images/sort/up-arrow.png"
                      v-show="sortBy == 'price' && sortDirection == 'ASC'"
                    >
                    <img
                      src="/images/sort/down-arrow.png"
                      v-show="sortBy == 'price' && sortDirection == 'DESC'"
                    >
                  </li>
                </ul>
              </div>
            </div>
            <!-- End Sort by -->
            <!-- View by -->
            <div class="view-by float-right">
              <ul>
                <li>
                  <a href="hotel-list.html" title>
                    <img src="/images/icon-grid.png" alt>
                  </a>
                </li>
                <li>
                  <a href="hotel-list-2.html" title class="current">
                    <img src="/images/icon-list.png" alt>
                  </a>
                </li>
                <li>
                  <a href="hotel-maps.html" title>
                    <img src="/images/icon-map.png" alt>
                  </a>
                </li>
              </ul>
            </div>
            <!-- View by -->
          </div>
          <!-- End Sort by and View by -->
          <!-- Hotel Grid Content-->
          <div class="hotel-list-cn clearfix">
            <!-- Hotel Item -->
            <div v-for="tour in tours" :key="tour.id" class="hotel-list-item">
              <figure class="hotel-img float-left">
                <a :href="'tours/' + tour.slug " title>
                  <img :src="'/images/hunting/' + tour.image " alt>
                </a>
              </figure>
              <div class="hotel-text">
                <div class="hotel-name">
                  <a :href="'tours/' + tour.slug " title>{{ tour.title }}</a>
                </div>

                <div class="hotel-star-address">
                  <span class="hotel-star">
                    <i class="glyphicon glyphicon-star"></i>
                    <i class="glyphicon glyphicon-star"></i>
                    <i class="glyphicon glyphicon-star"></i>
                    <i class="glyphicon glyphicon-star"></i>
                    <i class="glyphicon glyphicon-star"></i>
                  </span>
                  <!-- <span class="rating">
                                            <span>{{ $tour->rating }}</span>
                  </span>-->
                  <address class="hotel-address">{{ tour.region.name }}, {{ tour.country.name }}</address>
                </div>
                <p>
                  {{ tour.description }}...
                  <a href title>view all 125 reviews</a>
                </p>
                <hr class="hr">
                <div class="price-box float-left">
                  <span class="price old-price">From-</span>
                  <span class="price special-price">
                    ${{ tour.price }}
                    <small>/night</small>
                  </span>
                </div>
                <div class="hotel-service float-right">
                  <a href title>
                    <img src="/images/icon-service-1.png" alt>
                  </a>
                  <a href title>
                    <img src="/images/icon-service-2.png" alt>
                  </a>
                  <a href title>
                    <img src="/images/icon-service-3.png" alt>
                  </a>
                  <a href title>
                    <img src="/images/icon-service-4.png" alt>
                  </a>
                  <a href title>
                    <img src="/images/icon-service-5.png" alt>
                  </a>
                  <a href title>
                    <img src="/images/icon-service-6.png" alt>
                  </a>
                  <a href title>
                    <img src="/images/icon-service-7.png" alt>
                  </a>
                </div>
              </div>
            </div>
            <!-- End Hotel Item -->
          </div>
          <!-- End Hotel Grid Content-->
          <!-- Page Navigation -->
          <div class="page-navigation-cn">
            <ul class="page-navigation">
              <!--<li class="first"><a href="" title="">First</a></li>-->
              <li>
                <a
                  v-on:click="fetchPaginateUsers(pagination.prev_page_url)"
                  :disabled="!pagination.prev_page_url"
                >Prev</a>
              </li>

              <li
                v-for="last_page in pagination.last_page"
                :key="last_page"
                v-bind:class="{ current: ('http://tours.loc/api/tours?page='+last_page) == url }"
              >
                <a
                  v-on:click="fetchPaginateUsers('http://tours.loc/api/tours?page='+last_page)"
                >{{ last_page }}</a>
              </li>

              <!-- <li>
                <a href title>...</a>
              </li>-->
              <li class="last">
                <a
                  v-on:click="fetchPaginateUsers(pagination.next_page_url)"
                  :disabled="!pagination.next_page_url"
                >Last</a>
              </li>
            </ul>
          </div>
          <!-- Page Navigation -->
        </section>
        <!-- End Hotel List -->
      </div>
      <!-- End Hotel Right -->
      <!-- Sidebar Hotel -->
      <div class="col-md-3 col-md-pull-9">
        <!-- Sidebar Content -->
        <div class="sidebar-cn">
          <!-- Search Result -->
          <div class="search-result">
            <p>
              {{ $t('sort.we_found') }}
              <br>
              <ins>{{ tours_count }}</ins>
              <span>{{ $t('sort.properties_availability') }}</span>
            </p>
          </div>
          <!-- End Search Result -->
          <!-- Hotel facilities -->
          <div class="widget-sidebar facilities-sidebar">
            <h4 class="title-sidebar">Hotel facilities</h4>
            <ul class="widget-ul">
              <li
                v-for="region in regions"
                :key="region.id"
                v-bind:class="{ bolt: region_id == region.id }"
              >
                <a v-on:click="orderByRegion(region.id)">{{ region.name }}</a>
                <span>{{ region.tour_count }}</span>
              </li>
            </ul>
          </div>
          <!-- End Hotel facilities -->
          <!-- Area -->
          <div class="widget-sidebar area-sidebar">
            <h4 class="title-sidebar">Area</h4>
            <ul class="widget-ul">
              <li
                v-for="category in categories"
                :key="category.id"
                v-bind:class="{ bolt: category_id == category.id }"
              >
                <a v-on:click="orderByCategory(category.id)">{{ category.name }}</a>
                <span>{{ category.tour_count }}</span>
              </li>
            </ul>
          </div>
          <!-- End Area -->
        </div>
        <!-- End Sidebar Content -->
      </div>
      <!-- End Sidebar Hotel -->
    </div>
  </div>
</template>

<script>
// import vueSlider from "vue-slider-component";

export default {
  // components: {
  //   vueSlider
  // },
  data() {
    return {
      tours: [],
      pagination: [],
      categories: [],
      regions: [],
      tours_count: "",
      specie_name: "",
      language_locale: "",
      region_id: "",
      category_id: "",

      url: "/api/tours",

      sortBy: "title",
      sortDirection: "ASC"
    };
  },

  methods: {
    getTours() {
      let $this = this;

      axios.get(this.url).then(response => {
        this.tours = response.data.tours.data;
        this.categories = response.data.categories;
        this.regions = response.data.regions;

        this.tours_count = response.data.tours_count;
        this.specie_name = response.data.specie_name;

        this.$i18n.locale = response.data.language_locale;
        $this.makePagination(response.data.tours);
      });
    },

    makePagination(data) {
      let pagination = {
        current_page: data.current_page,
        last_page: data.last_page,
        next_page_url: data.next_page_url,
        prev_page_url: data.prev_page_url,
        path: data.path
      };

      this.pagination = pagination;
    },

    fetchPaginateUsers(url) {
      this.url = url;
      this.getTours();
    },

    orderByRegion(region_id) {
      let $this = this;
      this.region_id = region_id;
      axios
        .post(this.url, {
          region_id: region_id
        })
        .then(response => {
          this.tours = response.data.tours.data;
          this.tours_count = response.data.tours_count;
          $this.makePagination(response.data.tours);
        });
    },

    orderByCategory(category_id) {
      let $this = this;
      $this.category_id = category_id;
      axios
        .post(this.url, {
          category_id: category_id
        })
        .then(response => {
          this.tours = response.data.tours.data;
          this.tours_count = response.data.tours_count;
          $this.makePagination(response.data.tours);
        });
    },

    resortCafes(by) {
      if (by == this.sortBy) {
        if (this.sortDirection == "ASC") {
          this.sortDirection = "DESC";
        } else {
          this.sortDirection = "ASC";
        }
      }

      if (by != this.sortBy) {
        this.sortDirection = "ASC";
        this.sortBy = by;
      }

      switch (this.sortBy) {
        case "title":
          this.sortCompaniesByName();
          break;

        case "price":
          this.sortCompaniesByPendingActions();
          break;
      }
    },

    sortCompaniesByName() {
      this.tours.sort(
        function(a, b) {
          if (this.sortDirection == "ASC") {
            return a.title == b.title ? 0 : a.title > b.title ? 1 : -1;
          }

          if (this.sortDirection == "DESC") {
            return a.title == b.title ? 0 : a.title < b.title ? 1 : -1;
          }
        }.bind(this)
      );
    },

    sortCompaniesByPendingActions() {
      this.tours.sort(
        function(a, b) {
          if (this.sortDirection == "ASC") {
            return parseInt(a.price) < parseInt(b.price) ? 1 : -1;
          }

          if (this.sortDirection == "DESC") {
            return parseInt(a.price) > parseInt(b.price) ? 1 : -1;
          }
        }.bind(this)
      );
    }
  },

  mounted() {
    this.getTours();
  }
};
</script>

<style>
ul > li > a {
  cursor: pointer;
}
</style>
