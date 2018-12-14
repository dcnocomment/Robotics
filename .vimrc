if v:lang =~ "utf8$" || v:lang =~ "UTF-8$"
   set fileencodings=utf-8
"   set fileencodings=utf-8,latin1
endif

set nocompatible	" Use Vim defaults (much better!)
set bs=2		" allow backspacing over everything in insert mode
"set ai			" always set autoindenting on
"set backup		" keep a backup file
set nobackup
set nowritebackup
set noswapfile
set background=dark

set viminfo='20,\"50	" read/write a .viminfo file, don't store more
			" than 50 lines of registers
set history=50		" keep 50 lines of command line history
set ruler		" show the cursor position all the time
set number
set tabstop=4
syntax on
set softtabstop=4
set shiftwidth=4
set cindent
set autoindent
set ts=4
set expandtab

"the default buffer encoding
set enc=utf-8
"encoding detection
set fencs=utf-8,gbk,gb2312,big5,utf-16
"set fencs=gbk,gb2312,big5,utf-16
"set fileencodings=ucs-bom,utf-8,cp936,gb18030,big5,euc-jp,euc-kr,latin1
set fileencodings=gbk,gb2312
"set termencoding=utf-8
set termencoding=gbk
set ffs=unix,dos,mac
" Only do this part when compiled with support for autocommands
if has("autocmd")
  " In text files, always limit the width of text to 78 characters
  autocmd BufRead *.txt set tw=78
  " When editing a file, always jump to the last cursor position
  autocmd BufReadPost *
  \ if line("'\"") > 0 && line ("'\"") <= line("$") |
  \   exe "normal! g'\"" |
  \ endif
endif

if has("cscope")
   set csprg=/usr/bin/cscope
   set csto=0
   set cst
   set nocsverb
   " add any database in current directory
   if filereadable("cscope.out")
      cs add cscope.out
   " else add database pointed to by environment
   elseif $CSCOPE_DB != ""
      cs add $CSCOPE_DB
   endif
   set csverb
endif

" Switch syntax highlighting on, when the terminal has colors
" Also switch on highlighting the last used search pattern.
if &t_Co > 2 || has("gui_running")
  syntax on
  set hlsearch
endif
if &term=="xterm"
     set t_Co=8 
     set t_Sb=[4%dm
     set t_Sf=[3%dm
endif
"vim-php-add
"let g:debuggerPort=9001
nmap <silent> <F7> :NERDTree ~/<CR>
nmap <silent> <F6> :TagbarToggle<CR>
let g:tagbar_ctags_bin = 'ctags'
let g:tagbar_width = 30
"set runtimepath+=/home/caojiandong/tools

":inoremap ( ()<ESC>i
"		:inoremap ) <c-r>=ClosePair(')')<CR>
":inoremap { {}<ESC>i
"	:inoremap } <c-r>=ClosePair('}')<CR>
"	:inoremap [ []<ESC>i
"	:inoremap ] <c-r>=ClosePair(']')<CR>
"	:inoremap < <><ESC>i
"	:inoremap > <c-r>=ClosePair('>')<CR>
"	:inoremap " ""<ESC>i
"	:inoremap ' ''<ESC>i
"
"	function ClosePair(char)
"	    if getline('.')[col('.') - 1] == a:char
"		        return "\<Right>"
"				    else
"					        return a:char
"							    endif
"								endf
"
if has('mouse')
	set mouse=
endif
