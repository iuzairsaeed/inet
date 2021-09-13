
/*
** This is to simulate requesting information from a server.
**
** It has 2 functions:
** fetchUsers() - returns a complete list of users' ids and names.
** fetchUser(id) - returns the full information about a single user id.
**
** Both of these functions have a slight delay to simulate a server request.
*/

var userNames_1 = [] ;
  $.ajax({
        type: "GET",
        url: `${base_url}allusers`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        success: function (data) {

          var response = data;
         // response = JSON.stringify(response);

           console.log(response.data.length);

          for(i=0; i < response.data.length; i++){

            userNames_1.push.apply(userNames_1, [response.data[i].name]);

            

           // userNames +=response.data[i].name;

           
          }


             

           },

        error: function (err) {
            console.log(err);
        },
    });



var fakeServer = (function () {
  /* Use tinymce's Promise shim */
  var Promise = tinymce.util.Promise;

  var userNames1 = userNames_1;


  console.log(userNames1);
  console.log(userNames_1);



  /* Some user names for our fake server */
  var userNames = [
    'Inet Ed', 'Learn finall', 'Teacher final', 'Muddasir Ali', 'Athullya R', 'Kurt Semm',
    'Teacher with code', 'student Ali', 'Sarim Test', 'Abdul Goatherd', 'Test Teacher', 'math abc',
    'Science one', 'english abc', 'Test abc', 'demo abc', 'Audra Aucoin', 'Kurt Semm',
    'Jason Shure', 'Carlo Panico', 'Arjun Jayadev', 'Salahudidn Abc'
  ];


  /* some user profile images for our fake server */
  // var images = [
  //   'camilarocun', 'brianmichel', 'absolutehype', '4l3d', 'lynseybrowne', 'hi_kendall', '4ae78e7058d2434', 'yusuf_y7',
  //   'beauty__tattoos', 'mehrank36176270', 'fabriziocuscini', 'hassaminian', 'mediajorge', 'alexbienz', 'eesates', 'donjain',
  //   'austinknight', 'ehlersd', 'bipiiin', 'victorstuber', 'curiousoffice', 'chowdhury_sayan', 'upslon', 'gcauchon', 'pawel_murawski',
  //   'mr_r_a', 'jeremieges', 'nickttng', 'patrikward', 'sinecdoques', 'gabrielbeduschi', 'ashmigosh', 'shxnx', 'laborisova',
  //   'anand_2688', 'mefahad', 'puneetsmail', 'jefrydagucci', 'duck4fuck', 'verbaux', 'nicolasjengler', 'sorousht_', 'am0rz',
  //   'dominiklevitsky', 'jarjan', 'ganilaughs', 'namphong122', 'tiggreen', 'allisongrayce', 'messagepadapp', 'madebylipsum',
  //   'tweetubhai', 'avonelink', 'ahmedkojito', 'piripipirics', 'dmackerman', 'markcipolla'
  // ];

  /* some user profile descriptions for our fake server */
  // var descriptions = [
  //   'I like to work hard, play hard!',
  //   'I drink like a fish, that is a fish that drinks coffee.',
  //   'OutOfCheeseError: Please reinstall universe.',
  //   'Do not quote me.',
  //   'No one reads these things right?'
  // ];

  /* This represents a database of users on the server */
  var userDb = {};
  userNames.map(function (fullName) {
    var name = fullName.toLowerCase().replace(/ /g, '');
  
    return {
      id: name,
      name: name,
      fullName: fullName,
     
    };
  }).forEach(function(user) {
    userDb[user.id] = user;
  });

  /* This represents getting the complete list of users from the server with the details required for the mentions "profile" item */
  var fetchUsers = function() {
    return new Promise(function(resolve, _reject) {
      /* simulate a server delay */
      setTimeout(function() {
        var users = Object.keys(userDb).map(function(id) {
          return {
            id: id,
            name: userDb[id].name,
          
          };
        });
        resolve(users);
      }, 500);
    });
  };

  /* This represents requesting all the details of a single user from the server database */
  var fetchUser = function(id) {
    return new Promise(function(resolve, reject) {
      /* simulate a server delay */
      setTimeout(function() {
        if (Object.prototype.hasOwnProperty.call(userDb, id)) {
          resolve(userDb[id]);
        }
        reject('unknown user id "' + id + '"');
      }, 300);
    });
  };

  return {
    fetchUsers: fetchUsers,
    fetchUser: fetchUser
  };
})();

/* These are "local" caches of the data returned from the fake server */
var usersRequest = null;
var userRequest = {};

var mentions_fetch = function (query, success) {
  /* Fetch your full user list from somewhere */
  if (usersRequest === null) {
    usersRequest = fakeServer.fetchUsers();
  }
  usersRequest.then(function(users) {
    /* query.term is the text the user typed after the '@' */
    users = users.filter(function (user) {
      return user.name.indexOf(query.term.toLowerCase()) !== -1;
    });

    users = users.slice(0, 10);

    /* Where the user object must contain the properties `id` and `name`
       but you could additionally include anything else you deem useful. */
    success(users);
  });
};

var mentions_menu_hover = function (userInfo, success) {
  /* request more information about the user from the server and cache it locally */
  if (!userRequest[userInfo.id]) {
    userRequest[userInfo.id] = fakeServer.fetchUser(userInfo.id);
  }
  userRequest[userInfo.id].then(function(userDetail) {
    var div = document.createElement('div');

    div.innerHTML = (
    '<div class="card">' +
      '<h1>' + userDetail.fullName + '</h1>' +
      '<p>' + userDetail.description + '</p>' +
    '</div>'
    );

    success(div);
  });
};

var mentions_menu_complete = function (editor, userInfo) {
  var span = editor.getDoc().createElement('span');
  span.className = 'mymention';
  span.setAttribute('data-mention-id', userInfo.id);
  span.appendChild(editor.getDoc().createTextNode('@' + userInfo.name));
  return span;
};

var mentions_select = function (mention, success) {
  /* `mention` is the element we previously created with `mentions_menu_complete`
     in this case we have chosen to store the id as an attribute */
  var id = mention.getAttribute('data-mention-id');
  /* request more information about the user from the server and cache it locally */
  if (!userRequest[id]) {
    userRequest[id] = fakeServer.fetchUser(id);
  }
  userRequest[id].then(function(userDetail) {
    var div = document.createElement('div');
    div.innerHTML = (
      '<div class="card">' +
      '<h1>' + userDetail.fullName + '</h1>' +
      '</div>'
    );
    success(div);
  });
};



