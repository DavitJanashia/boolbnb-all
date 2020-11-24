window.$ = require('jquery');

export function searchOnMapSliderChecked(lat, lng, slider, hits){

var APPLICATION_ID = 'Y49WMBJIFT';
var SEARCH_ONLY_API_KEY = '63b572a22a729de27551ac2f07780053';
var INDEX_NAME = 'apartments';
var PARAMS = {hitsPerPage: 60};

var algolia = algoliasearch(APPLICATION_ID, SEARCH_ONLY_API_KEY);
var algoliaHelper = algoliasearchHelper(algolia, INDEX_NAME, PARAMS);
algoliaHelper.setQueryParameter('getRankingInfo', true);

var $map = $('#mapApiGoogle');
var $hits = $('#hits');
var $searchInput = $('#search-input');
var hitsTemplate = Hogan.compile($('#hits-template').text());
var noResultsTemplate = Hogan.compile($('#no-results-template').text());

var map = new google.maps.Map($map.get(0), {
  streetViewControl: false,
  mapTypeControl: false,
  zoom: 4,
  minZoom: 3,
  maxZoom: 12,
  styles: [{stylers: [{hue: '#3596D2'}]}]
});
var fitMapToMarkersAutomatically = true;
var markers = [];
var boundingBox;
var boundingBoxListeners = [];

var PAGE_STATES = {};
var pageState;
setPageState(PAGE_STATES.BOUNDING_BOX_RECTANGLE);

function setPageState(state) {
  resetPageState();
  beginPageState(state);
}

function beginPageState(state) {
  pageState = state;

  switch (state) {

    case PAGE_STATES.BOUNDING_BOX_RECTANGLE:
      boundingBox = new google.maps.Circle({
        strokeColor: '#EF5362',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#EF5362',
        fillOpacity: 0.15,
        // draggable: true,
        // editable: true,
        geodesic: true,
        map: map,
        center: { lat: parseFloat(lat), lng: parseFloat(lng) },
        radius:parseFloat(slider), //20 km
      });


      google.maps.event.addListener(boundingBox, 'radius_changed', function () {
        console.log(boundingBox.getRadius(),'my radius from google');
        var getEditableRadius = boundingBox.getRadius();

        function setMySliderRadius() {
          let sliderForApi = $("#mySliderRadius");
          let outputForApi = $("#sliderValue");
          outputForApi.html('');
          let myKms = getEditableRadius/1000;
          outputForApi.append(myKms.toFixed(2));
          sliderForApi.val(getEditableRadius);

        }
        setMySliderRadius();
      });


      algoliaHelper.setQueryParameter('insideBoundingBox', rectangleToAlgoliaParams(boundingBox));
      boundingBoxListeners.push(google.maps.event.addListener(
        boundingBox,
        'bounds_changed',
        throttle(rectangleBoundsChanged, 150)
      ));
      break;
  }

  fitMapToMarkersAutomatically = true;
  algoliaHelper.search();
}

function resetPageState() {
  if (boundingBox) boundingBox.setMap(null);
  for (var i = 0; i < boundingBoxListeners.length; ++i) {
    google.maps.event.removeListener(boundingBoxListeners[i]);
  }
  boundingBoxListeners = [];
  $searchInput.val('');
  algoliaHelper.setQuery('');
  algoliaHelper.setQueryParameter('insideBoundingBox', undefined);
  algoliaHelper.setQueryParameter('aroundLatLng', undefined);
  algoliaHelper.setQueryParameter('aroundLatLngViaIP', undefined);
}


$searchInput.on('input propertychange', function (e) {
  var query = e.currentTarget.value;
  if (pageState === PAGE_STATES.BOUNDING_BOX_RECTANGLE || pageState === PAGE_STATES.BOUNDING_BOX_POLYGON) {
    fitMapToMarkersAutomatically = false;
  }
  algoliaHelper.setQuery(query).search();
});


algoliaHelper.on('result', function (content) {
  renderMap(content);
  renderHits(content);
});

algoliaHelper.on('error', function (error) {
  console.log(error);
});

function renderHits(content) {
  if (content.hits.length === 0) {
    $hits.html(noResultsTemplate.render());
    return;
  }
  content.hits = content.hits.slice(0, 20);

  // console.log(content.hits,'content hits');

  for (var i = 0; i < content.hits.length; ++i) {
    var hit = content.hits[i];
    hit.displayCity = (hit.name === hit.city);
    if (hit._rankingInfo.matchedGeoLocation) {
      hit.distance = parseInt(hit._rankingInfo.matchedGeoLocation.distance / 1000, 10) + ' km';
    }
  }
  $hits.html(hitsTemplate.render(content));
}

function renderMap(content) {
  removeMarkersFromMap();
  markers = [];

  for (var i = 0; i < content.hits.length; ++i) {
    var hit = content.hits[i];

    for (var j = 0; j < hits.length; j++) {
      var myHit = hits[j];

      if(myHit.objectID == hit.objectID){

        var marker = new google.maps.Marker({
          position: {lat: hit._geoloc.lat, lng: hit._geoloc.lng},
          map: map,
        });
        markers.push(marker);
      }
    }
  }
  if (fitMapToMarkersAutomatically) fitMapToMarkers();
}

function updateMenu(stateClass, modeClass) {
  $('.change_page_state').removeClass('active');
  $('.change_page_state[data-state="' + stateClass + '"]').addClass('active');
  $('.page_mode').removeClass('active');
  $('.page_mode[data-mode="' + modeClass + '"]').addClass('active');
}

function fitMapToMarkers() {
  var mapBounds = new google.maps.LatLngBounds();
  // console.log(markers,'my markersss');
  for (var i = 0; i < markers.length; i++) {
    mapBounds.extend(markers[i].getPosition());
  }
  map.fitBounds(mapBounds);
}

function removeMarkersFromMap() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
}

function rectangleBoundsChanged() {
  fitMapToMarkersAutomatically = false;
  algoliaHelper.setQueryParameter('insideBoundingBox', rectangleToAlgoliaParams(boundingBox)).search();
}

function rectangleToAlgoliaParams(rectangle) {
  var bounds = rectangle.getBounds();
  var ne = bounds.getNorthEast();
  var sw = bounds.getSouthWest();
  return [ne.lat(), ne.lng(), sw.lat(), sw.lng()].join();
}


function attachInfoWindow(marker, hit) {
  var message;

  if (hit.name === hit.city) {
    message = hit.name + ' - ' + hit.country;
  } else {
    message = hit.name + ' - ' + hit.city + ' - ' + hit.country;
  }

  var infowindow = new google.maps.InfoWindow({content: message});
  marker.addListener('click', function () {
    setTimeout(function () {infowindow.close();}, 3000);
  });
}

function throttle(func, wait) {
  var context;
  var args;
  var result;
  var timeout = null;
  var previous = 0;
  function later() {
    previous = Date.now();
    timeout = null;
    result = func.apply(context, args);
    if (!timeout) context = args = null;
  }
  return function () {
    var now = Date.now();
    var remaining = wait - (now - previous);
    context = this;
    args = arguments;
    if (remaining <= 0 || remaining > wait) {
      if (timeout) {
        clearTimeout(timeout);
        timeout = null;
      }
      previous = now;
      result = func.apply(context, args);
      if (!timeout) {
        context = args = null;
      }
    } else if (!timeout) {
      timeout = setTimeout(later, remaining);
    }
    return result;
  };
}
// });

}
