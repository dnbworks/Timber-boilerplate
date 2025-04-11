import { invalid } from "../utils/invalid";


const { HTMLElement } = window;



export class SiteNav extends HTMLElement {
  constructor() {
    // You can initialize or bind elements here if needed
				console.log("yeah");
  }

  open(control, third) {
    control.classList.add("open", "d-block");
    if (third) {
      third.setAttribute("aria-expanded", "true");
      third.classList.add("open");
    }
  }

  close(control, third) {
    control.classList.remove("d-block", "open");
    if (third) {
      third.setAttribute("aria-expanded", "false");
      third.classList.remove("open");
    }
  }

  inputColor() {
    this.value !== "" ? this.nextElementSibling.classList.add("active") : this.nextElementSibling.classList.remove("active");
  }

  toggleSearch(searchDiv, siteSearchClose) {
    if (searchDiv.classList.contains("d-block")) {
      this.close(searchDiv, siteSearchClose);
    } else {
      this.open(searchDiv, siteSearchClose);
      this.querySelector(".search__input").focus();
    }
  }

  toggleMenu(e, auxMenus) {
    const opened = e.currentTarget.classList.contains("open");

    for (let i = 0; i < auxMenus.length; i++) {
      this.close(auxMenus[i], auxMenus[i].nextElementSibling);
    }

    opened
      ? this.close(e.currentTarget, e.currentTarget.nextElementSibling)
      : this.open(e.currentTarget, e.currentTarget.nextElementSibling);

    e.preventDefault();
    return false;
  }

  openHam(closeHamBtn, toggleHamBtn, hamBackOverlay) {
    this.open(closeHamBtn, this.getElementById("site-ham-menu"), toggleHamBtn);
    hamBackOverlay.classList.add("open");
    this.querySelector("body").classList.add("ham-open");
    toggleHamBtn.classList.remove("reverse");
  }

  closeHam(closeHamBtn, toggleHamBtn, hamBackOverlay) {
    this.close(closeHamBtn, this.getElementById("site-ham-menu"), toggleHamBtn);
    hamBackOverlay.classList.remove("open");
    this.querySelector("body").classList.remove("ham-open");
    toggleHamBtn.classList.add("reverse");
  }

  toggleHam(toggleHamBtn, closeHamBtn, hamBackOverlay) {
    const opened = toggleHamBtn.classList.contains("open");
    opened ? this.closeHam(closeHamBtn, toggleHamBtn, hamBackOverlay) : this.openHam(closeHamBtn, toggleHamBtn, hamBackOverlay);
  }

  closeHamClick(e, hamBackOverlay) {
    const hamContainer = this.querySelector("#site-nav .ham-menu");

    if (hamContainer.classList.contains("open") && hamBackOverlay.contains(e.target)) {
      this.closeHam(this.getElementById("site-ham-menu"), null, hamBackOverlay);
    }
  }

  changeMenuHeights(el, type) {
    const openedHamMenus = this.querySelectorAll("#site-ham-menu li.open");
    const openedSibling = el.parentElement.parentElement.querySelector("li.open > ul");
    const siblingHeight = openedSibling ? openedSibling.offsetHeight : 0;

    for (let i = 0; i < openedHamMenus.length; i++) {
      const openedList = openedHamMenus[i].children[openedHamMenus[i].children.length - 1];
      const listHeight = type === "closing"
        ? -Math.abs(el.nextElementSibling.offsetHeight)
        : el.nextElementSibling.childElementCount * 40 - siblingHeight;

      const subtractedHeight = openedList.offsetHeight + listHeight;
      openedList.style.height = `${subtractedHeight}px`;
    }
  }

  closeSubMenus(el) {
    const openedHamLists = el.nextElementSibling.getElementsByTagName("ul");

    for (let i = 0; i < openedHamLists.length; i++) {
      this.close(openedHamLists[i].previousElementSibling, openedHamLists[i].parentElement);
      openedHamLists[i].style.height = "0px";
    }
  }

  closeSiblings(el) {
    const allOpenedSiblings = el.parentElement.parentElement.querySelectorAll("button.open");

    allOpenedSiblings.forEach(sibling => {
      this.close(sibling, sibling.parentElement);
      sibling.nextElementSibling.style.height = "0px";
    });
  }

  toggleMenusHam(e) {
    const el = e.currentTarget;
    if (el.classList.contains("open")) {
      this.changeMenuHeights(el, "closing");
      this.closeSubMenus(el);
      this.close(el, el.parentElement);
      el.nextElementSibling.style.height = "0px";
    } else {
      this.changeMenuHeights(el, "opening");
      this.closeSiblings(el);
      this.open(el, el.parentElement);
      el.nextElementSibling.style.height = `${el.nextElementSibling.childElementCount * 40}px`;
    }
  }

  getPage(el) {
    if (!el.includes(".aspx")) {
      if (el[el.length - 1] !== "/") el += "/";
      el += "index.aspx";
    }
    return el;
  }

  openParents(el) {
    let height = 0;
    while (el && el !== document && !el.classList.contains("ham-menu-list")) {
      if (el.tagName === "UL") {
        height += 40 * el.childElementCount;
        el.style.height = `${height}px`;
      } else if (el.tagName === "LI") {
        const currentButton = el.querySelector("button");
        this.open(currentButton, el);
      }
      el = el.parentNode;
    }
  }

  activateHamCurrentLink() {
    const allHamLinks = this.querySelectorAll("#site-ham-menu a");
    const urlPath = this.getPage(window.location.pathname);

    for (let i = 0; i < allHamLinks.length; i++) {
      const thisLink = this.getPage(allHamLinks[i].href);

      if (thisLink.includes(urlPath) && urlPath !== '/index.aspx') {
        allHamLinks[i].setAttribute("aria-current", "page");
        this.openParents(allHamLinks[i].parentNode.parentNode);
        break;
      }
    }
  }

  hamSetUp() {
    const toggleHamBtns = this.querySelectorAll("#site-ham-menu ul button");

    for (let i = 0; i < toggleHamBtns.length; i++) {
      toggleHamBtns[i].addEventListener("click", (e) => this.toggleMenusHam(e));
    }

    this.activateHamCurrentLink();
  }
}



