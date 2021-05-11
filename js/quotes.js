// document.addEventListener('readystatechange', () => {
//   if(document.readyState === 'complete') console.log("I have changed");
// })
let filterValue = 0;

const btn = document.getElementById('filter-btn');
const filterSelection = document.querySelector('#filter-selection');
const authorSelection = document.querySelector('div.author-select-container');
const categorySelection = document.querySelector('div.category-select-container');
const filterBtn = document.querySelector('button.filter-submit');
const limitSection = document.querySelector('div.filter-input-container');
const addAuthorBtn = document.querySelector('button.add-author-btn');
const addAuthorContainer = document.querySelector('div.add-author-container');
const addCategoryBtn = document.querySelector('button.add-category-btn');
const addCategoryContainer = document.querySelector('div.add-category-container');

if(btn) {
  btn.addEventListener('click', (e) => {
    const filter = document.querySelector('div.filter-select-container');
    if(filter.classList.contains('hidden')) {
      filter.classList.remove("hidden");
      if(filterValue === 0) {
        limitSection.classList.remove('hidden');
      }
    }else{
      filter.classList.add('hidden');
    }

    // if(!e.currentTarget.classList.contains('filter-selection')) {
    //   filter.classList.add('hidden');
    // }
    // filter.setAttribute('style', 'display: block');
  })
}

if(filterSelection) {
  filterSelection.addEventListener('change', (e) => {
    filterValue = parseInt(e.currentTarget.value);
    if(filterValue === 0) {
      authorSelection.classList.add('hidden');
      categorySelection.classList.add('hidden');
      if(limitSection.classList.contains('hidden')) {
        limitSection.classList.remove('hidden');
      }
    }else if(filterValue === 1) {
      if(authorSelection.classList.contains('hidden')) {
        authorSelection.classList.remove('hidden');
      }
      if(!categorySelection.classList.contains('hidden')) {
        categorySelection.classList.add('hidden');
      }
      if(!limitSection.classList.contains('hidden')) {
        limitSection.classList.add('hidden');
      }
    }else if(filterValue === 2) {
      if(!authorSelection.classList.contains('hidden')) {
        authorSelection.classList.add('hidden');
      }
      if(categorySelection.classList.contains('hidden')) {
        categorySelection.classList.remove('hidden');
      }
      if(!limitSection.classList.contains('hidden')) {
        limitSection.classList.add('hidden');
      }
    }else {
      if(authorSelection.classList.contains('hidden')) {
        authorSelection.classList.remove('hidden');
      }
      if(categorySelection.classList.contains('hidden')) {
        categorySelection.classList.remove('hidden');
      }
      if(!limitSection.classList.contains('hidden')) {
        limitSection.classList.add('hidden');
      }
    }

    // if(filterValue !== 0) {
    //   if(filterBtn.classList.contains('hidden')) {
    //     filterBtn.classList.remove('hidden');
    //   }
    // }else {
    //   if(!filterBtn.classList.contains('hidden')) {
    //     filterBtn.classList.add('hidden');
    //   }
    // }

  })
}

if(addAuthorBtn) {
  document.addEventListener('click', () => {
    addAuthorBtn.classList.add('hidden');
    addAuthorContainer.classList.remove('hidden');
  })
}

if(addCategoryBtn) {
  document.addEventListener('click', () => {
    addCategoryBtn.classList.add('hidden');
    addCategoryContainer.classList.remove('hidden');
  })
}