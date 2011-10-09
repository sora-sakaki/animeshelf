window.onload = function () {
  var comment = document.getElementById('comment');
  comment.addEventListener('keydown', function (data){
    if (data.keyCode === 13) {
      if (data.ctrlKey) {
        document.sendForm.submit();
        return false;
      }
    }
  });
}

function openSearch() {
  $.get('search_anime.php?searchKey='+document.searchForm.searchKey.value, function (data) {
    try {
      var jsonData = JSON.parse(data);
    } catch (e) {
      console.log("error : " + data);
      return;
    }

    window.prepareSendForm = function (animeId, storyId) {
      $('#animeName').html(jsonData[animeId]['title']['name']);
      document.sendForm.animeName.value = jsonData[animeId]['title']['name'];
      $('#animeNumber').html('第'+jsonData[animeId]['story'][storyId]['story_num']+'話 「'+jsonData[animeId]['story'][storyId]['sub_title']+'」');
      document.sendForm.animeNumber.value = jsonData[animeId]['story'][storyId]['story_num'];

      $('#searchResultMain').fadeOut(500, function () {
        $('#searchResult').slideUp(500);
        document.sendForm.comment.focus();
        $('#searchResultMain').remove();
        $('#searchResult').remove();
      });
    }

    window.displayStory = function () {
      var page = 0;
      
      return function (id) {
        var storyHTML = '';
        for (var j = 0; j < 2; j++) {
          storyHTML += '<div class="animeLine" id="line_'+j+'">';
          var displayStartStoryNum = 8 * page + j * 4;
          for (var i = displayStartStoryNum; i < jsonData[id]['story'].length; i++) {
            if (i >= displayStartStoryNum + 4) break;
            storyHTML += '<div class="animeBlock" id="story_'+i+'" onClick="prepareSendForm('+id+','+i+')">';
            storyHTML += '<div class="animeSamnail" id="story_'+i+'_samnail">';
            storyHTML += '<img src="'+jsonData[id]['title'].samnail_url+'">';
            storyHTML += '</div>';
            storyHTML += '<div class="animeName" id="story_'+i+'_name">';
            storyHTML += jsonData[id]['story'][i].sub_title;
            storyHTML += '</div><!-- animeSamnail -->';
            storyHTML += '</div><!-- animeBlock -->';
          }
          storyHTML += '</div><!-- animeLine -->';
        }

        $('#searchResultMain').fadeOut(500, function () {
          $('#searchResultMain').html(storyHTML);
          $('#searchResultMain').fadeIn(500);
        });
      };
    }();

    var titleHTML = '';
    titleHTML += '<div class="animeLine">';
    for (var i = 0; i < jsonData.length; i++) {
      titleHTML += '<div class="animeBlock focusBlock" id="title_'+i+'" onClick="displayStory('+i+')">';
      titleHTML += '<div class="animeSamnail" id="title_'+i+'_samnail">';
      titleHTML += '<img src="'+jsonData[i]['title'].samnail_url+'">';
      titleHTML += '</div>';
      titleHTML += '<div class="animeName" id="title_'+i+'_name">';
      titleHTML += jsonData[i]['title'].name;
      titleHTML += '</div><!-- animeSamnail -->';
      titleHTML += '</div><!-- animeBlock -->';
    }
    titleHTML += '</div><!-- animeLine -->';
    var mainDiv = document.createElement('div');
    mainDiv.setAttribute('id', 'searchResultMain');
    mainDiv.setAttribute('style', 'display:none;position:fixed;width:80%;height:80%;left:10%;top:10%;background-color:#fff;z-index:100;opacity:1');
    mainDiv.innerHTML = titleHTML;

    var backDiv = document.createElement('div');
    backDiv.setAttribute('id', 'searchResult');
    backDiv.setAttribute('style', 'display:none;position:fixed;width:100%;height:100%;left:0;top:0;background-color:#521;z-index:99;opacity:0.8');

    document.body.appendChild(mainDiv);
    document.body.appendChild(backDiv);
    $('#searchResult').slideDown(500, function () {
      $('#searchResultMain').fadeIn(500);
      
      var searchForm = document.getElementById('searchKey');
      searchForm.blur();
      document.body.addEventListener('keydown', function (data){
        if (data.keyCode === 13) {
          displayStory(0);
          document.body.removeEventListener('keydown', arguments.callee);
        }
      });
     
    });
  });
}

