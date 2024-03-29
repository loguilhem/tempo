import Chart from 'chart.js/auto';
import $ from 'jquery';

$(document).ready(function () {
  graphProjects();
  graphTasks();
  graphUsers();

  showProjects(true);
  showTasks(false);
  showUsers(false);
  showRecords(false);

  $('#showRecords').on('click', function () {
      showRecords(true);
      showProjects(false);
      showTasks(false);
      showUsers(false);
  })

  $('#showProjects').on('click', function () {
    showRecords(false);
    showProjects(true);
    showTasks(false);
    showUsers(false);
  })

  $('#showTasks').on('click', function () {
    showRecords(false);
    showProjects(false);
    showTasks(true);
    showUsers(false);
  })

  $('#showUsers').on('click', function () {
    showRecords(false);
    showProjects(false);
    showTasks(false);
    showUsers(true);
  })
})

function showProjects(show)
{
  let $projects = $('#analytics-projects');
  let $projectsTab = $('#projects');
  if (show) {
    $projects.show();
    $projectsTab.show();
  } else {
    $projects.hide();
    $projectsTab.hide();
  }
}

function showTasks(show)
{
  let $tasks = $('#analytics-tasks');
  let $tasksTab = $('#tasks');
  if (show) {
    $tasks.show();
    $tasksTab.show();
  } else {
    $tasks.hide();
    $tasksTab.hide();
  }
}

function showUsers(show)
{
  let $users = $('#analytics-users');
  let $usersTab = $('#users');
  if (show) {
    $users.show();
    $usersTab.show();
  } else {
    $users.hide();
    $usersTab.hide();
  }
}

function showRecords(show)
{
  let $records = $('#analytics-all-records');
  let $recordsTab = $('#all-records');
  if (show) {
    $records.show();
    $recordsTab.show();
  } else {
    $records.hide();
    $recordsTab.hide();
  }
}

function graphProjects()
{
  let $projects = $('#projects');
  let projects = $projects.attr('data-projects');
  let colorTasks = [];
  let colorUsers = [];
  $.each(JSON.parse(projects), function (iProject, project) {
    // task data
    let labelTasks = [];
    let dataTasks = [];
    $.each(project.tasks, function (iTask, task) {
      labelTasks.push(task.name);
      dataTasks.push(task.total);
      colorTasks.push(colorGenerator());
    })

    //user data
    let labelUsers = [];
    let dataUsers = [];
    $.each(project.users, function (iUser, user) {
      labelUsers.push(user.username);
      dataUsers.push(user.total);
      colorUsers.push(colorGenerator());
    })

      let ctxPt = document.getElementById('project-task-' + iProject).getContext("2d");
      new Chart(ctxPt, {
        type: 'pie',
        data: {
          labels: labelTasks,
          datasets: [{
            label: labelTasks,
            data: dataTasks,
            backgroundColor: colorTasks,
            borderColor: colorTasks,
            borderWidth: 1
          }]
        },
        options: {
          title: {
            text: project.name,
            display: true,
            position: top,
          }
        }
      });

    let ctxPu = document.getElementById('project-user-' + iProject).getContext("2d");
    new Chart(ctxPu, {
      type: 'pie',
      data: {
        labels: labelUsers,
        datasets: [{
          label: labelUsers,
          data: dataUsers,
          backgroundColor: colorUsers,
          borderColor: colorUsers,
          borderWidth: 1
        }]
      },
      options: {
        title: {
          text: project.name,
          display: true,
          position: top,
        }
      }
    });
  })
}

function graphTasks() {
  let $tasks = $('#tasks');
  let tasks = $tasks.attr('data-tasks');
  let colorProjects = [];
  let colorUsers = [];
  $.each(JSON.parse(tasks), function (iTask, task) {
    // project data
    let labelProjects = [];
    let dataProjects = [];
    $.each(task.projects, function (iProject, project) {
      labelProjects.push(project.name);
      dataProjects.push(project.total);
      colorProjects.push(colorGenerator());
    })

    //user data
    let labelUsers = [];
    let dataUsers = [];
    $.each(task.users, function (iUser, user) {
      labelUsers.push(user.username);
      dataUsers.push(user.total);
      colorUsers.push(colorGenerator());
    })

    let ctxTp = document.getElementById('task-project-' + task.id).getContext("2d");
    new Chart(ctxTp, {
      type: 'pie',
      data: {
        labels: labelProjects,
        datasets: [{
          label: labelProjects,
          data: dataProjects,
          backgroundColor: colorProjects,
          borderColor: colorProjects,
          borderWidth: 1
        }]
      },
      options: {
        title: {
          text: task.name,
          display: true,
          position: top,
        }
      }
    });

    let ctxTu = document.getElementById('task-user-' + task.id).getContext("2d");
    new Chart(ctxTu, {
      type: 'pie',
      data: {
        labels: labelUsers,
        datasets: [{
          label: labelUsers,
          data: dataUsers,
          backgroundColor: colorUsers,
          borderColor: colorUsers,
          borderWidth: 1
        }]
      },
      options: {
        title: {
          text: task.name,
          display: true,
          position: top,
        }
      }
    });
  })
}

function graphUsers() {
  let $users = $('#users');
  let users = $users.attr('data-users');
  let colorProjects = [];
  let colorTasks = [];
  $.each(JSON.parse(users), function (iUser, user) {
    // project data
    let labelProjects = [];
    let dataProjects = [];
    $.each(user.projects, function (iProject, project) {
      labelProjects.push(project.name);
      dataProjects.push(project.total);
      colorProjects.push(colorGenerator());
    })

    //task data
    let labelTasks = [];
    let dataTasks = [];
    $.each(user.tasks, function (iTask, task) {
      labelTasks.push(task.name);
      dataTasks.push(task.total);
      colorTasks.push(colorGenerator());
    })

    let ctxUp = document.getElementById('user-project-' + user.id).getContext("2d");
    new Chart(ctxUp, {
      type: 'pie',
      data: {
        labels: labelProjects,
        datasets: [{
          label: labelProjects,
          data: dataProjects,
          backgroundColor: colorProjects,
          borderColor: colorProjects,
          borderWidth: 1
        }]
      },
      options: {
        title: {
          text: user.username,
          display: true,
          position: top,
        }
      }
    });

    let ctxUt = document.getElementById('user-task-' + user.id).getContext("2d");
    new Chart(ctxUt, {
      type: 'pie',
      data: {
        labels: labelTasks,
        datasets: [{
          label: labelTasks,
          data: dataTasks,
          backgroundColor: colorTasks,
          borderColor: colorTasks,
          borderWidth: 1
        }]
      },
      options: {
        title: {
          text: user.username,
          display: true,
          position: top,
        }
      }
    });
  })
}

/* COLOR GENERATOR */
function colorGenerator() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }

  return color;
}