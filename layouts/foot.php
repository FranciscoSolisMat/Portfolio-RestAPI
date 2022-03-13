</div>
<div class="bg-indigo-600 p-5">
    <div class="container mx-auto flex justify-between">
        <h1 data-request="page=actions;" class="text-2xl font-bold text-white">© FranciscoSolis <span copyright-year></span></h1>
        <h3 class="text-xl">Contact: <a class="text-teal-400 hover:opacity-75" href="mailto:fran@franciscosolis.cl">fran@franciscosolis.cl</a></h3>
    </div>
</div>
<script>
    
    document.querySelectorAll('[copyright-year]').forEach(function(e){
        let start = 2022
        let current = new Date().getFullYear()
        if(start !== current){
            e.innerText = `${start} - ${current}`
        } else {
            e.innerText = `${start}`
        }
    });
    
    document.querySelectorAll('[data-code]').forEach((el) => {
        // Loop through the lines and add the line numbers
        let id = window.lastCodeId || 1
        window.lastCodeId = id + 1
        let html = ''
        let lines = el.innerHTML.substring(el.innerHTML.indexOf('{'), el.innerHTML.length).split('\n') // workaround for the json code always adding 4 whitespaces at the start
        for (let i = 1; i <= lines.length; i++) {
            html += `<span class="text-md flex items-center w-full" id="code-${id}-${i}"><span class="text-gray-300 ml-2" data-line-number>${i}&nbsp>&nbsp</span> <span data-line-content>${lines[i-1]}</span></span>`
        }
        el.innerHTML = `<code class="my-2" data-code="${id}">${html}</code>`
    })
    
    const onMouseDown = (el) => {
        if(el.id.startsWith('code-')){
            const codeId = el.id.split('-')[1]
            const lineId = el.id.split('-')[2]
            document.querySelectorAll('[data-code-line-selected]').forEach(el => {
                el.removeAttribute('data-code-line-selected')
                el.classList.remove('bg-yellow-700')
            })
            const line = document.getElementById(`code-${codeId}-${lineId}`)
            line.setAttribute('data-code-line-selected', '1')
            line.classList.add('bg-yellow-700')
            return true
        } else if(el.parentElement.id.startsWith('code-')) {
            return onMouseDown(el.parentElement)
        } else if(el.hasAttribute('data-clipboard')) {
            let base64 = el.getAttribute('data-clipboard')
            let text = atob(base64)
            navigator.clipboard.writeText(text).then(() => {
                console.log('Copied to clipboard')
            }).catch(err => {
                console.error('Failed to copy to clipboard', err)
            })
            return true
        }  else if(el.tagName.toLowerCase() === 'a') {
            // Parse host from href
            const host = el.href.split('/')[2]
            // Parse host from current url
            const currentHost = window.location.href.split('/')[2]
            // If the host is different, open in new tab
            if(host !== currentHost) {
                window.open(el.href, '_blank')
            } else {
                window.open(el.href, '_self')
            }
            return true
        } else if(el.hasAttribute('data-request')){
            updateRequest(el.getAttribute('data-request'))
            return true
        }
        
        return false
    }
    
    document.addEventListener('click', ($event) => {
        if(onMouseDown($event.target)) {
            $event.preventDefault()
            $event.stopPropagation()
        }
    })
    
    document.addEventListener('keydown', (event) => {
        const el = document.querySelectorAll('[data-code-line-selected]')[0]
        if(el){
            const codeId = el.id.split('-')[1]
            const lineId = el.id.split('-')[2]
            if(event.key === 'c' && (event.ctrlKey || event.metaKey)){
                event.preventDefault()
                const code = document.getElementById(`code-${codeId}-${lineId}`)
                const lineContent = code.querySelector('[data-line-content]').innerHTML
                navigator.clipboard.writeText(lineContent).then(() => {
                    console.log('Copied to clipboard')
                }, (err) => {
                    console.error('Failed to copy to clipboard', err)
                })
            }
        }
    })
    
    document.querySelectorAll('[data-request]').forEach(el => el.classList.add('cursor-pointer'))
    
    let urlparams = new URLSearchParams(window.location.search)
    if(urlparams.has('error') && urlparams.get('page') !== 'error'){
        urlparams.delete('error')
        window.history.pushState({}, '', `${window.location.pathname}?${urlparams.toString()}`)
    }
    
</script>
</body>