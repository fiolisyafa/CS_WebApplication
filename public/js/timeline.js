var currentDay = 0, selectedActivity = -1;

function _(selector) {
  return document.querySelector(selector);
}

function createElementFromHTML(htmlString) {
  var div = document.createElement('div');
  div.innerHTML = htmlString.trim();

  // Change this to div.childNodes to support multiple top-level nodes
  return div.firstChild; 
}

Date.daysBetween = function( date1, date2 ) {
  //Get 1 day in milliseconds
  var one_day=1000*60*60*24;

  // Convert both dates to milliseconds
  var date1_ms = date1.getTime();
  var date2_ms = date2.getTime();

  // Calculate the difference in milliseconds
  var difference_ms = date2_ms - date1_ms;
    
  // Convert back to days and return
  return Math.round(difference_ms/one_day); 
}

//gets the user's custom activities for the current itinerary
function fetchCustom() {
  var current = localStorage.getItem('currentItinerary');
  fetch(`http://mochinerary.id/api/itinerary/${current}/custom`, {
    method: 'get',
     headers: {
       'Content-Type': 'application/json',
       'Accept': 'application/json',
       'Authorization': 'Bearer ' + localStorage.getItem('token'),
     },
    })
    .then(res => {
      if (!res.ok) {
          throw Error(res.statusText);
      }
      return res.json();
    })
    .then(result => {
      var activities = JSON.parse(localStorage.activities);
      var a = [...activities, ...result];

      localStorage.setItem('activities', JSON.stringify(a));

      fetchItinerary();
    }).catch(err => {
      console.log('error');
    });
}

//gets the user's selected activities for the current itinerary
function fetchSelected() {
  var current = localStorage.getItem('currentItinerary');
  fetch(`http://mochinerary.id/api/itinerary/${current}/selected`, {
    method: 'get',
     headers: {
       'Content-Type': 'application/json',
       'Accept': 'application/json',
       'Authorization': 'Bearer ' + localStorage.getItem('token'),
     },
    })
    .then(res => {
      if (!res.ok) {
          throw Error(res.statusText);
      }
      return res.json();
    })
    .then(result => {
      localStorage.setItem('activities', JSON.stringify(result));

      fetchItinerary();

      console.log(result);
      console.log('berhasil');
    }).catch(err => {
      console.log('error');
    });
}

//gets the details of the suggested activities that were selected by the users
function fetchSuggested() {
  var current = localStorage.getItem('currentItinerary');
  fetch(`http://mochinerary.id/api/itinerary/${current}/suggested`, {
    method: 'get',
     headers: {
       'Content-Type': 'application/json',
       'Accept': 'application/json',
       'Authorization': 'Bearer ' + localStorage.getItem('token'),
     },
    })
    .then(res => {
      if (!res.ok) {
          throw Error(res.statusText);
      }
      return res.json();
    })
    .then(result => {
      localStorage.setItem('activities', JSON.stringify(result));

      fetchItinerary();

      console.log(result);
      console.log('berhasil');
    }).catch(err => {
      console.log('error');
    });
}

//displaying all the selected and custom activities based on the day
function displayActivitiesOnDay(day) {
  var result = JSON.parse(localStorage.getItem('activities'));
  var itinerary = JSON.parse(localStorage.getItem('itinerary'));

  document.getElementById('activity-list').innerHTML = '';

  result.forEach(r => {
    var date = new Date(r.date_time.split(' ')[0]);
    var time = r.date_time.split(' ')[1];
    var dateFrom = new Date(itinerary.date_from);

    var dayIndex = Date.daysBetween(dateFrom, date);

    if (dayIndex === day) {
      console.log(r.activity);
      var name = r.activity ? r.activity.name : r.name;
      var fee = r.activity ? r.activity.fee : r.fee;
      var node = createElementFromHTML(`<div class="all">
            <div class="duration">
             <div class="part1">
              ${time}
             </div>
            </div>
            <div class="items">
             <div class="part3">
              ${name}
             </div>
             <div class="part4">
              $${fee}
             </div> 
            </div>
            <span class="close" onclick="deleteFunction('${r.id}')">x</span>        
           </div>`);
      document.getElementById('activity-list').appendChild(node);
    }
  });
}

//deletes an activity from the itinerary
function deleteFunction(activity) {
  var current = localStorage.getItem('currentItinerary');
  fetch(`http://mochinerary.id/api/itinerary/${current}/${activity}/delete`, {
    method: 'delete',
    headers: {
     'Content-Type': 'application/json',
     'Accept': 'application/json',
     'Authorization': 'Bearer ' + localStorage.getItem('token'),
    },   
  })
 .then(res => {
      if (!res.ok) {
          throw Error(res.statusText);
      }
      return res.json();
    })
    .then(result => {
      fetchSelected();
      fetchCustom();
    });
}

//dynamically adds a cell depending on the number of days the trip has
function fetchItinerary() {
  var current = localStorage.getItem('currentItinerary');
  fetch(`http://mochinerary.id/api/dashboard/${current}`, {
    method: 'get',
     headers: {
       'Content-Type': 'application/json',
       'Accept': 'application/json',
       'Authorization': 'Bearer ' + localStorage.getItem('token'),
     },
    })
    .then(res => {
      if (!res.ok) {
          throw Error(res.statusText);
      }
      return res.json();
    })
    .then(result => {
      var dateFrom = new Date(result[0].date_from),
        dateTo = new Date(result[0].date_to);

      var days = Date.daysBetween(dateFrom, dateTo) + 1;

      if (_('#days-list').childNodes.length == 1) {
        for (var i = 0; i < days; i++) {
          var node = document.createElement('div');
          node.classList.add('gallery-cell');
          node.innerHTML = 'Day ' + (i + 1);
          node.id = 'day-' + (i + 1);
          document.getElementById('days-list').appendChild(node);
        }
        var elem = document.querySelector('#days-list');
        var flkty = new Flickity(elem);

        flkty.on('change', function(index) {
          displayActivitiesOnDay(index);
          currentDay = index;
        });
      }

      localStorage.setItem('itinerary', JSON.stringify(result[0]));

      displayActivitiesOnDay(currentDay);
    });
}

//adds a custom activity to the itinerary
function submitCustom() {
  var current = localStorage.getItem('currentItinerary');
  var itinerary = JSON.parse(localStorage.getItem('itinerary'));

  var currentSelectedDate = new Date(itinerary.date_from);
  currentSelectedDate.setDate(currentSelectedDate.getDate() + currentDay);

  var hour = _('#hour').value;
  var date_time = `${currentSelectedDate.getFullYear()}-${currentSelectedDate.getMonth() + 1}-${currentSelectedDate.getDate()} ${hour}`;

  var data = {
    name: _('#event-input').value,
    description: _('#description-input').value,
    fee: _('#budget-input').value,
    date_time: date_time
  };

  fetch(`http://mochinerary.id/api/itinerary/${current}/create`, {
   method: 'put',
   headers: {
     'Content-Type': 'application/json',
     'Accept': 'application/json',
     'Authorization': 'Bearer ' + localStorage.getItem('token'),
   },
   body: JSON.stringify(data)
  })
    .then(res => {
      if (!res.ok) {
          throw Error(res.statusText);
      }
      return res.json();
    })
    .then(result => {
      console.log(result);
      var activities = JSON.parse(localStorage.activities);
      var a = [...activities, result];

      localStorage.setItem('activities', JSON.stringify(a));

      fetchItinerary();
    });
}

//retreives the suggested activities as filtered by the user's preferences
function fetchSugg() {
  var current = localStorage.getItem('currentItinerary');
  fetch(`http://mochinerary.id/api/itinerary/${current}/browse`, {
    method: 'get',
     headers: {
       'Content-Type': 'application/json',
       'Accept': 'application/json',
       'Authorization': 'Bearer ' + localStorage.getItem('token'),
     },
    })
    .then(res => {
      if (!res.ok) {
          throw Error(res.statusText);
      }
      return res.json();
    })
    .then(result => {
      console.log(result);
      result.forEach(r => {
        var html = createElementFromHTML(`<div class="insidesuggestion" onclick="myFunction3(${r.id})">
          <div class="category">
            ${r.activity_type.type}
          </div>
          <div class="theitem">
            ${r.name}
          </div>
        </div>`);

        _('#suggested-list').appendChild(html);
      });

      // console.log(result);
    }).catch(err => {
      console.log('error');
    });
}

//adds a suggested activity to the itinerary
function submitSugg() {
  var current = localStorage.getItem('currentItinerary');
  var itinerary = JSON.parse(localStorage.getItem('itinerary'));

  var currentSelectedDate = new Date(itinerary.date_from);
  currentSelectedDate.setDate(currentSelectedDate.getDate() + currentDay);

  var hour = _('#hour-suggested').value;
  var date_time = `${currentSelectedDate.getFullYear()}-${currentSelectedDate.getMonth() + 1}-${currentSelectedDate.getDate()} ${hour}`;

  var data = {
    date_time: date_time,
    activity_id: selectedActivity
  };

  fetch(`http://mochinerary.id/api/itinerary/${current}/add/${selectedActivity}`, {
   method: 'put',
   headers: {
     'Content-Type': 'application/json',
     'Accept': 'application/json',
     'Authorization': 'Bearer ' + localStorage.getItem('token'),
   },
   body: JSON.stringify(data)
  })
    .then(res => {
      if (!res.ok) {
          throw Error(res.statusText);
      }
      return res.json();
    })
    .then(result => {
      console.log(result);
      var activities = JSON.parse(localStorage.activities);
      var a = [...activities, result];

      localStorage.setItem('activities', JSON.stringify(a));

      fetchItinerary();
    });
}

function myFunction3(activity) {
  document.getElementById('kaode').classList.toggle('hilang');
  selectedActivity = activity;
}

window.onload = () => {
  fetchSugg();
  fetchSelected();
  fetchCustom();
  console.log(JSON.parse(localStorage.getItem('itinerary')));
}