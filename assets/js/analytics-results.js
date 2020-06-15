require('../css/analytics-results.scss');
import Chart from 'chart.js';
var $ = require('jquery');

$(document).ready(function () {
  graphProjects();
  graphTasks();
  graphUsers();
})

function graphProjects() {
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
    let ptX = new Chart(ctxPt, {
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
    let puX = new Chart(ctxPu, {
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
    let ctX = new Chart(ctxTp, {
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
    let tuX = new Chart(ctxTu, {
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
    let ctX = new Chart(ctxUp, {
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
    let tuX = new Chart(ctxUt, {
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