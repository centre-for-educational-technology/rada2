<template>
  <div class="location-based-photos">
    <div class="form-group">
      <label>{{ $t('labels.proximity') }}</label>
      <p class="help-block">
        {{ $t('help.proximity') }}
      </p>
      <div class="input-group">
        <span class="input-group-addon">
          <i class="mdi mdi-radar" aria-hidden="true"></i>
        </span>
        <input
            type="number"
            class="form-control"
            min="25"
            max="5000"
            v-model="distance"
            :disabled="inAjaxCall">
      </div>
    </div>

    <div ref="map" class="map google-maps-map"></div>

    <span :class="{ badge: true, 'animated infinite flash': inAjaxCall }">{{ $t('image-upload.results') }} {{ totalPhotos }}</span>

    <div class="image-search-result-columns">
      <div
          v-for="(result, index) in photos"
          :key="index"
          class="col-sm-6 col-md-4"
      >
        <div class="thumbnail">
          <div class="thumbnail-image">
            <img :src="result.image_url" alt="image">
            <provider-logo
                :id="result.id"
                :provider="result.provider"
                :external-page-url="getExternalPageUrl(result)"
            ></provider-logo>
          </div>
          <div class="caption">
            <span class="badge">{{ distanceToText(result.distance_in_meters) }}</span>
            <h3>{{ result.title }}</h3>
            <p v-if="result.description">{{ result.description }}</p>
            <p>
              <a
                  href="#"
                  class="btn btn-primary"
                  role="button"
                  @click.prevent="onAddClicked(result)"
              >
                {{ $t('image-upload.buttons.add') }}
              </a>
              <a
                  href="#"
                  class="btn btn-default"
                  role="button"
                  @click.prevent="onDetailsClicked(result)"
              >
                {{ $t('image-upload.buttons.details') }}
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center" v-if="nextUrl">
      <a
          href="#"
          :class="{ 'btn btn-default': true, 'animated infinite flash': inAjaxCall }"
          role="button"
          @click.prevent="onLoadMoreClicked()"
          :disabled="inAjaxCall"
      >
        {{ $t('buttons.load-more')}}
      </a>
    </div>
  </div>
</template>

<script>

import debounce from '../../../debounce';

export default {
  name: 'LocationBased',
  components: {
    'provider-logo': require('../ProviderLogo.vue').default
  },
  props: ['apiUrl', 'baseUrl', 'mapsApiKey', 'mapCenterLatitude', 'mapCenterLongitude'],
  mounted() {
    const vm = this;

    this.latitude = Number(this.mapCenterLatitude);
    this.longitude = Number(this.mapCenterLongitude);

    this.mapData = {};

    if (window.hasOwnProperty('google') && window.google.hasOwnProperty('maps')) {
      this.initMap();
      vm.$nextTick(function() {
        vm.search();
      });
    } else {
      // TODO This should not be used like that
      window.initMap = function() {
        vm.initMap();
        vm.$nextTick(function() {
          vm.search();
        });
      };

      const script = document.createElement('script');
      script.type = 'text/javascript';
      script.src = `//maps.googleapis.com/maps/api/js?key=${this.mapsApiKey}&callback=initMap&libraries=geometry`;
      script.async = true;
      script.defer = true;
      document.body.appendChild(script);
    }
  },
  data() {
    return {
      inAjaxCall: false,
      totalPhotos: 0,
      photos: [],
      nextUrl: '',
      distance: 500,
      latitude: null,
      longitude: null
    };
  },
  methods: {
    initMap() {
      this.mapData.mapOptions = {
        center: {
          lat: Number(this.mapCenterLatitude),
          lng: Number(this.mapCenterLongitude)
        },
        zoom: 7,
        mapTypeId: window.google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        zoomControl: true,
        streetViewControl: false,
        styles: [
          {
            featureType: 'poi',
            stylers: [{visibility: 'off'}]
          },
          {
            featureType: 'transit.station',
            stylers: [{visibility: 'off'}]
          },
        ]
      };
      this.mapData.map = new window.google.maps.Map(this.$refs.map, this.mapData.mapOptions);

      this.mapData.marker = new window.google.maps.Marker({
        title: '',
        position: {
          lat: this.latitude,
          lng: this.longitude
        },
        map: this.mapData.map,
        animation: google.maps.Animation.DROP,
        draggable: true
      });

      this.mapData.marker.addListener('dragend', event => {
        this.latitude = event.latLng.lat();
        this.longitude = event.latLng.lng();

        this.search();
      });

      this.mapData.searchCircle = new google.maps.Circle({
        map: this.mapData.map,
        radius: this.distance,
        fillColor: 'blue',
        fillOpacity: 0.25,
        strokeColor: 'blue',
        strokeWeight: 1,
        strokeOpacity: 0.5
      });

      this.mapData.searchCircle.bindTo('center', this.mapData.marker, 'position');

      this.$watch('distance', debounce(function(newVal) {
        this.mapData.searchCircle.setRadius(Number(newVal));
        this.search();
      }, 500));

      this.$watch('inAjaxCall', function(newVal) {
        if (newVal == true) {
          this.mapData.marker.setOpacity(0.5);
          this.mapData.marker.setDraggable(false);
        }
        if (newVal == false) {
          this.mapData.marker.setOpacity(1);
          this.mapData.marker.setDraggable(true);
        }
      });

      // TODO This might have to be split into a separate method
      if ( !window.navigator.geolocation ) {
        return false;
      }

      var gameControls = document.createElement('div'),
          controlUI = document.createElement('div');

      controlUI.id = 'sz-map-controls';
      controlUI.className = 'map-controls'
      gameControls.appendChild(controlUI);

      var navigationControlItem = document.createElement('i');
      navigationControlItem.className = 'mdi mdi-target';
      navigationControlItem.title = this.$t('set-current-position');
      controlUI.appendChild(navigationControlItem);

      const vm = this;
      var inGeoposition = false;
      navigationControlItem.addEventListener('click', function() {
        if ( inGeoposition ) return;
        inGeoposition = true;

        navigationControlItem.style.color = '#cccccc';
        window.navigator.geolocation.getCurrentPosition(
            function(position) {
              navigationControlItem.style.color = null;
              inGeoposition = false;
              vm.updatePosition(position);
            },
            function(error) {
              navigationControlItem.style.color = null;
              inGeoposition = false;
              alert(vm.$t('geolocation-error'));
              console.error('Geolocation error', error);
            }, {
              enableHighAccuracy: true
            });
      });

      this.mapData.map.controls[window.google.maps.ControlPosition.TOP_RIGHT].push(gameControls);
    },
    loadPhotos(params, append) {
      const vm = this;
      const data = {};
      let url = this.apiUrl + '/location/photos';

      if (params) {
        data.params = params;
      }

      if (append) {
        url = this.nextUrl;
      }

      vm.inAjaxCall = true;

      return this.$http.get(url, data).then(response => {
        vm.inAjaxCall = false;
        vm.totalPhotos = response.body.total;
        vm.nextUrl = response.body.next;

        if (append) {
          vm.photos.push(..._.clone(response.body.results));
        } else {
          vm.photos = _.clone(response.body.results);
        }
      }, () => {
        vm.inAjaxCall = false;
      });
    },
    getExternalPageUrl(result) {
      return result.page_url ? result.page_url : result.image_url;
    },
    onAddClicked(result) {
      this.$parent.$emit('location-based-image-selected', result.id, result.image_url, this.getExternalPageUrl(result), result.provider);
    },
    onDetailsClicked(result) {
      window.open(this.getExternalPageUrl(result), '_blank');
    },
    search() {
      this.loadPhotos({
        latitude: this.latitude,
        longitude: this.longitude,
        distance: this.distance ? this.distance : 25
      }, false);
    },
    distanceToText(value) {
      if (value > 1000) {
        return `${(Number(value) / 1000).toFixed(2)} ${this.$t('image-upload.distance-units.short.kilometres')}`;
      }

      return `${Number(value).toFixed()} ${this.$t('image-upload.distance-units.short.metres')}`;
    },
    onLoadMoreClicked() {
      this.loadPhotos(null, true);
    },
    updatePosition(position) {
      const latLng = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      this.latitude = latLng.lat;
      this.longitude = latLng.lng;
      this.mapData.map.panTo(latLng);
      this.mapData.marker.setPosition(latLng);
      this.mapData.marker.setAnimation(window.google.maps.Animation.BOUNCE);
      setTimeout(() => {
        this.mapData.marker.setAnimation(null);
      }, 500);
      this.search();
    }
  }
}
</script>

<style scoped>
.location-based-photos .form-group {
  margin-left: 0;
  margin-right: 0;
}

.location-based-photos > .badge {
  margin-bottom: 1em;
}

.map {
  width: 100%;
  min-height: 300px;
  margin-bottom: 1em;
}

.image-search-result-columns .thumbnail .caption h3 {
  margin-top: 0.25em;
}

.thumbnail > .thumbnail-image {
  position: relative;
}

.thumbnail > .thumbnail-image > img {
  display: block;
  max-width: 100%;
  height: auto;
  margin-right: auto;
  margin-left: auto;
}

.thumbnail > .thumbnail-image > .provider-logo {
  position: absolute;
  left: 2px;
  bottom: 2px;
}
</style>