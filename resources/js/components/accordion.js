document.addEventListener("DOMContentLoaded", function() {
  const accordionItemHeaders = document.querySelectorAll(".faq__head");
  const accordionItemBodies = document.querySelectorAll(".faq__answer");

  accordionItemHeaders[0].classList.add("faq__head--active");
  accordionItemBodies[0].style.maxHeight = accordionItemBodies[0].scrollHeight + "px";

  accordionItemHeaders.forEach((accordionItemHeader, index) => {
    accordionItemHeader.addEventListener("click", event => {
      const currentlyActiveAccordionItemHeader = document.querySelector(".faq__head.faq__head--active");
      if (currentlyActiveAccordionItemHeader && currentlyActiveAccordionItemHeader !== accordionItemHeader) {
        currentlyActiveAccordionItemHeader.classList.toggle("faq__head--active");
        const currentlyActiveAccordionItemBody = currentlyActiveAccordionItemHeader.nextElementSibling;
        currentlyActiveAccordionItemBody.style.maxHeight = 0;
        currentlyActiveAccordionItemBody.style.marginBottom = 0;
      }
      accordionItemHeader.classList.toggle("faq__head--active");
      const accordionItemBody = accordionItemHeader.nextElementSibling;
      if (accordionItemHeader.classList.contains("faq__head--active")) {
        accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
      } else {
        accordionItemBody.style.maxHeight = 0;
      }
    });
  });
});