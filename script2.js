const draggable_list = document.getElementById('draggable-list');
const check = document.getElementById('check');

// Store listitems
const listItems = [];

var input = document.getElementById("files");

let dragStartIndex;

let formData = new FormData();

const lisofFiles = [];

let hiddenArray = document.getElementById('hideArray').value;

let hidden_arr = hiddenArray.split(',');

createArray();

function createArray(){
  //Create an array of each file the was picked, appends to the array on each upload click

  for (var i = 0; i < hidden_arr.length; i++) {
    //Ensures no duplicates
    if(lisofFiles.includes(hidden_arr[i]) == false){
      lisofFiles.push(hidden_arr[i])
    }
  }

  for (var i = 0; i < input.files.length; i++) {
    //Ensures no duplicates
    if(lisofFiles.includes(input.files[i].name) == false){
      lisofFiles.push(input.files[i].name)
    }
  }

  //Create the visual list
  createList();
}

// Insert list items into DOM
function createList() {
  //Clear draggable list
  while(draggable_list.firstChild){
    draggable_list.removeChild(draggable_list.firstChild);
  }

  //Length of the number of files in the created array
  let leng = lisofFiles.length;

  while(listItems.length > 0) {
    listItems.pop();
  }

  //For each file that is in the lisofFiles array
  for (var i = 0; i < leng; i++) {
      const listItem = document.createElement('li');

      listItem.setAttribute('data-index', i);

      //File names that is in each row
      fies = lisofFiles[i];

      //Creates the individual sections in the list comprision of numner, data, and grip lines
        listItem.innerHTML = `
        <span class="number">${i + 1}</span>
        <div class="draggable" draggable="true">
          <p>${fies}</p>
          <i class="fas fa-grip-lines"></i>
        </div>
        `

      //Adds each individual item to the list
      listItems.push(listItem);
      
      //Adds li elemts to ul list 
      draggable_list.appendChild(listItem);

      //Uploads files to temporary folder on server
      formData.append("files", input.files[i]);
      fetch('/DreamTechLLC/process.php', {
        method: 'POST',
        body: formData,
      }).then((response) => {
        //console.log(response)
      });

  }
  
  addEventListeners();
}

function dragStart() {
  // console.log('Event: ', 'dragstart');
  dragStartIndex = +this.closest('li').getAttribute('data-index');
}

function dragEnter() {
  // console.log('Event: ', 'dragenter');
  this.classList.add('over');
}

function dragLeave() {
  // console.log('Event: ', 'dragleave');
  this.classList.remove('over');
}

function dragOver(e) {
  // console.log('Event: ', 'dragover');
  e.preventDefault();
}

function dragDrop() {
  // console.log('Event: ', 'drop');
  const dragEndIndex = +this.getAttribute('data-index');
  swapItems(dragStartIndex, dragEndIndex);

  this.classList.remove('over');
  checkOrder();
}

// Swap list items that are drag and drop
function swapItems(fromIndex, toIndex) {
  const itemOne = listItems[fromIndex].querySelector('.draggable');
  const itemTwo = listItems[toIndex].querySelector('.draggable');

  listItems[fromIndex].appendChild(itemTwo);
  listItems[toIndex].appendChild(itemOne);
}


// Check the order of list items
function checkOrder() {

  hiddenArray = document.getElementById('hideArray');
  hiddenArray.value = "";
  arrayofUploads = []

  listItems.forEach((listItem, i) => {
    const mediaName = listItem.querySelector('.draggable').innerText.trim();

    //Create an array of the uploaded media in the ordered sorted
    arrayofUploads.push(mediaName)

  });
  console.log(arrayofUploads);
  
  hiddenArray.value = arrayofUploads;
}

function addEventListeners() {
  const draggables = document.querySelectorAll('.draggable');
  const dragListItems = document.querySelectorAll('.draggable-list li');

  draggables.forEach(draggable => {
    draggable.addEventListener('dragstart', dragStart);
  });

  dragListItems.forEach(item => {
    item.addEventListener('dragover', dragOver);
    item.addEventListener('drop', dragDrop);
    item.addEventListener('dragenter', dragEnter);
    item.addEventListener('dragleave', dragLeave);
  });
}

check.addEventListener('click', checkOrder);