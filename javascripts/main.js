(function ($, undefined) {

  // Put custom repo URL's in this object, keyed by repo name.
  var repoUrls = ["email", "miner", "LBS", "notification"];

  function repoUrl(repo) {
    return repoUrls[repo.name] || repo.html_url;
  }

  // Put custom repo descriptions in this object, keyed by repo name.
  var repoDescriptions = {};

  function repoDescription(repo) {
    return repoDescriptions[repo.name] || repo.description;
  }

  function addRepo(repo) {
    var $item = $("<li>").addClass("repo pure-u-1-3 " + (repo.language || '').toLowerCase());
    var $link = $("<a>").attr("href", repoUrl(repo)).appendTo($item);
    $link.append($("<h2>").text(repo.name));
    $link.append($("<h3>").text(repo.language));
    $link.append($("<p>").text(repoDescription(repo)));
    $item.appendTo("#repos");
  }

  function addRepos(repos, page) {
    repos = repos || [];
    page = page || 1;

    var uri = "https://api.github.com/orgs/yoozi/repos?callback=?"
            + "&per_page=100"
            + "&page="+page;

    $.getJSON(uri, function (result) {
      if (result.data && result.data.length > 0) {
        repos = repos.concat(result.data);
        addRepos(repos, page + 1);
      }
      else {
        $(function () {
          // Convert pushed_at to Date.
          $.each(repos, function (i, repo) {

            repo.pushed_at = new Date(repo.pushed_at);

            var weekHalfLife  = 1.146 * Math.pow(10, -9);

            var pushDelta    = (new Date) - Date.parse(repo.pushed_at);
            var createdDelta = (new Date) - Date.parse(repo.created_at);

            var weightForPush = 1;
            var weightForWatchers = 1.314 * Math.pow(10, 7);

            repo.hotness = weightForPush * Math.pow(Math.E, -1 * weekHalfLife * pushDelta);
            repo.hotness += weightForWatchers * repo.watchers / createdDelta;
          });

          // Sort by highest # of watchers.
          repos.sort(function (a, b) {
            if (a.hotness < b.hotness) return 1;
            if (b.hotness < a.hotness) return -1;
            return 0;
          });

          $.each(repos, function (i, repo) {
            if ($.inArray(repo.name, repoUrls) < 0) return;
            addRepo(repo);
          });

          // Sort by most-recently pushed to.
          repos.sort(function (a, b) {
            if (a.pushed_at < b.pushed_at) return 1;
            if (b.pushed_at < a.pushed_at) return -1;
            return 0;
          });
        });
      }
    });
  }

  addRepos();
})(jQuery);
