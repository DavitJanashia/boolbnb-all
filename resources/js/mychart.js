window.$ = require('jquery');

// -----------------------------------------------------------------------------------------
function removeOldChart(){
  $('#myChart').remove();
  $('#views-chart').append('<canvas id="myChart"><canvas>');

  $('#myMsgChart').remove();
  $('#message-chart').append('<canvas id="mymessageChart"><canvas>');
}

// ----------------------------------------------------------------------------------------
function getMsgChart(msgToMatch, week){

  var ctx = document.getElementById('mymessageChart').getContext('2d');
  var myMsgChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: week,
          datasets: [{
              label: 'Numero di Messaggi',
              data: msgToMatch,
              pointBackgroundColor: "#55bae7",
              pointBorderColor: "#55bae7",
              pointHoverBackgroundColor: "#55bae7",
              pointHoverBorderColor: "#55bae7",
              backgroundColor: ['rgba(75, 192, 192, 0.2)' ],
              borderColor: [ 'rgba(75, 192, 192, 1)'],
              borderWidth: 1
          }]
      },
      options: {
                  responsive: true,
                  maintainAspectRatio:false,
                  title: {
                      display: true,
                      text: ["Messaggi ricevuti: ",  week[0] + " / " + week[6]] ,
                      fontSize: "14"
                  },
          scales: {
              yAxes: [{
                  ticks: {
                      stepSize: 1,
                      beginAtZero: true
                  }
              }]
          }
      }
  });


}

// ----------------------------------------------------------------------------------------
function getClickChart(arrayNewClick, week){

  var ctx = document.getElementById('myChart').getContext('2d');
  var myClickChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: week,
          datasets: [{
              label: 'Numero di Click',
              data: arrayNewClick,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(60, 80, 130, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(60, 80, 130, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
                  responsive: true,
                  maintainAspectRatio:false,
                  title: {
                      display: true,
                      text: ["Numero di Visualizzazioni: ",  week[0] + " / " + week[6]],
                      fontSize: "14"
                  },
          scales: {
              yAxes: [{
                  ticks: {
                      stepSize: 4,
                      beginAtZero: true
                  }
              }]
          }
      }
  });
  myClickChart.update();
}
// ----------------------------------------------------------------------------------------
function  getMessageData(id, week ){
    //console.log('ENTER MESSAGE DATA');
      var msgToMatch = [0,0,0,0,0,0,0];

    $.ajax({
      url:"/api/statistic/message/" + id,
      method:'GET',
      success: function(data,state){

            var objectLength= Object.keys(data).length;

            var daysMsg = [];
            var totMsg=[];

            for (var i = 0; i < objectLength; i++) {
              var values = Object.values(data)[i].length;
              totMsg.push(values);
              var keys = Object.keys(data)[i];
              daysMsg.push(keys);
            }

            //console.log("GIORNI",daysMsg);
            //console.log("QUANTITA MESSAGGI",totMsg);

            for (var i = 0; i < daysMsg.length; i++) {

                if(week.includes(daysMsg[i]) ){
                var key = week.indexOf(daysMsg[i]);
                msgToMatch[key] = totMsg[i];
              }
            }

            //console.log("GIORNI SETTIMANA",week);
            //console.log("MESSAGGI INTERCETTATI",msgToMatch);

            getMsgChart(msgToMatch, week);

        },
        error: function(err) {
          //console.log('error', err);
        }
      });
}

// -----------------------------------------------------------------------------------------
function getClickData( id, week ){
  //console.log('ENTER');
  var clickToMatch = [0,0,0,0,0,0,0];

  $.ajax({
    url:"/api/statistic/" + id,
    method:'GET',
    success: function(data,state){

      var datalength= data.length;

      var arrayNumOfClick = [];
      var arrayCurrentDatas = [];

      for (let key in data) {
        var dataFormat = moment(data[key]['current_date']).format("YYYY-MM-DD");
        arrayCurrentDatas.push(dataFormat);

        arrayNumOfClick.push(data[key]['number_of_click']);
      }

        for (var i = 0; i < datalength; i++) {

          if(week.includes(arrayCurrentDatas[i]) ){
            var key = week.indexOf(arrayCurrentDatas[i]);
            clickToMatch[key] = arrayNumOfClick[i];
          }
        }

        var arrayNewClick = clickToMatch;

      getClickChart(arrayNewClick, week);

    },
    error: function(err) {
      //console.log('error', err);
    }
  });
}

// -----------------------------------------------------------------------------------------

function nextWeek(id){

    removeOldChart();


    var mybutton = $('#chart-next').attr('click');
    var newstartdate = moment(mybutton).add( 1, 'week');

    $('#chart-prev').attr('click', newstartdate.format("YYYY-MM-DD"));
    $('#chart-next').attr('click', newstartdate.format("YYYY-MM-DD"));

    var nxtweek = [];

    for (var i = 0; i < 7; i++) {
      var day = newstartdate.add(1, "days").format("YYYY-MM-DD");
      nxtweek.push(day);
    };

    getClickData(id, nxtweek );
    getMessageData(id, nxtweek);
}

// -----------------------------------------------------------------------------------------

function prevWeek(id){

  removeOldChart();


    var mybutton = $('#chart-prev').attr('click');
    var newstartdate = moment(mybutton).subtract( 1, 'week');

    $('#chart-prev').attr('click', newstartdate.format("YYYY-MM-DD"));
    $('#chart-next').attr('click', newstartdate.format("YYYY-MM-DD"));

    var prvweek = [];

    for (var i = 0; i < 7; i++) {
      var day = newstartdate.add(1, "days").format("YYYY-MM-DD");
      prvweek.push(day);
    };

    getClickData(id, prvweek );
    getMessageData(id, prvweek );
}

// -----------------------------------------------------------------------------------------

function init(){

  var href = document.URL.split('/');
  var id = href.pop() || href.pop();

  var startdate = moment().add(1,'days');
  var week = [];

  for (var i = 0; i < 7; i++) {
    var day = startdate.subtract(1, "days").format("YYYY-MM-DD");
    week.push(day)
  };

  week.reverse();

  getMessageData( id, week);

  getClickData( id, week );

  var prevbuttonAttr = $('#chart-prev').attr('click', startdate.format("YYYY-MM-DD"));
  var nextbuttonAttr = $('#chart-next').attr('click', startdate.format("YYYY-MM-DD"));

  $('#chart-prev').on('click', function() {prevWeek(id)});
  $('#chart-next').on('click', function() {nextWeek(id)});

}

$(document).ready(init);




// ----------------------------------------------------------------------------------------
function getFakeData( id, week, msgToMatch ){
  var data = {
                "2020-10-29":[
                {"apartment_id":101,"created_at":"2020-10-29T12:52:12.000000Z"}
              ],
              "2020-11-02":[
                {"apartment_id":101,"created_at":"2020-11-02T12:50:13.000000Z"},
                {"apartment_id":101,"created_at":"2020-11-02T12:52:12.000000Z"},
                {"apartment_id":101,"created_at":"2020-11-02T12:52:12.000000Z"},
                {"apartment_id":101,"created_at":"2020-11-02T12:52:12.000000Z"}
              ],
              "2020-11-03":[
                {"apartment_id":102,"created_at":"2020-11-03T12:50:13.000000Z"},
                {"apartment_id":101,"created_at":"2020-11-03T12:52:12.000000Z"}]
              };

              var objectLength= Object.keys(data).length;
              var daysMsg = [];
              var totMsg=[];

              for (var i = 0; i < objectLength; i++) {
                var values = Object.values(data)[i].length;
                totMsg.push(values);
                var keys = Object.keys(data)[i];
                daysMsg.push(keys);
              }

              //console.log("GIORNI",daysMsg);
              //console.log("QUANTITA MESSAGGI",totMsg);

            for (var i = 0; i < daysMsg.length; i++) {

                if(week.includes(daysMsg[i]) ){
                var key = week.indexOf(daysMsg[i]);
                msgToMatch[key] = totMsg[i];
              }
            }
              //console.log("GIORNI SETTIMANA",week);
              //console.log("MESSAGGI INTERCETTATI",msgToMatch);
          }

// -----------------------------------------------------------------------------------------
