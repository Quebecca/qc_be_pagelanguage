// On load
// On récupérer l'UID courant
let languageSelectorElements = document.querySelector("[name='languageMenu']");

//if(!window.sessionStorage.getItem('codeExecuted')){
    require(['TYPO3/CMS/Core/Ajax/AjaxRequest'], function (AjaxRequest) {
        new AjaxRequest(TYPO3.settings.ajaxUrls.get_current_lang)
            //.withQueryArguments({pageUid: pageUid})
            .get()
            .then(async function (response) {
                response.resolve().then(function (result){
                    // language selected recently that stored in the DB
                    let currentSelectedLang = result['language_uid']


                 // current lang url
                  if(languageSelectorElements){
                      let params = new URLSearchParams(window.location.search)
                      ///params['SET[language]'] = 666;
                      params.set('SET[language]', 11)
                      // Représente la languege dans la valeur de l'option de select
                      const newQueryString = '/typo3/module/web/layout?'+params.toString();

  /*                    console.log(languageSelectorElements)
                      console.log(newQueryString)
                      console.log(currentSelectedLang)
*/

                      let changeEvent = new Event('change');
                      languageSelectorElements.value = newQueryString;

                      let selectedLang = languageSelectorElements.querySelector(`option[value="${newQueryString}"]`)

                      selectedLang.selected = true;


                      //languageSelectorElements.selectedIndex = 3
                      languageSelectorElements.dispatchEvent(changeEvent);
                      console.log(languageSelectorElements)

                  }

                })
            })

    })
//}






if(languageSelectorElements){
    languageSelectorElements.addEventListener('change', function(){
        let uri = languageSelectorElements.value
        const params = new URLSearchParams(uri)
        let langUid = params.get('SET[language]');
        // Envoyer cette prop to update the useLang in the table

    })
}

