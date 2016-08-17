<div class="sidebar sidebar-left">

    <div class="sidebar-header">
        <button type="button" class="sidebar-close"><span>×</span></button>
        <p class="sidebar-title">Navigation</p>
    </div>

    <ul class="nav navbar-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" id="drop1" data-toggle="dropdown" role="button"
               aria-haspopup="true" aria-expanded="false">
                Alphabet <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="drop1">
                <li class="{{ isActiveUrl('/alphabet/a') }}"><a href="/alphabet/a" title="A">A</a></li>
                <li class="{{ isActiveUrl('/alphabet/b') }}"><a href="/alphabet/b" title="B">B</a></li>
                <li class="{{ isActiveUrl('/alphabet/c') }}"><a href="/alphabet/c" title="C">C</a></li>
                <li class="{{ isActiveUrl('/alphabet/d') }}"><a href="/alphabet/d" title="D">D</a></li>
                <li class="{{ isActiveUrl('/alphabet/e') }}"><a href="/alphabet/e" title="E">E</a></li>
                <li class="{{ isActiveUrl('/alphabet/f') }}"><a href="/alphabet/f" title="F">F</a></li>
                <li class="{{ isActiveUrl('/alphabet/g') }}"><a href="/alphabet/g" title="G">G</a></li>
                <li class="{{ isActiveUrl('/alphabet/h') }}"><a href="/alphabet/h" title="H">H</a></li>
                <li class="{{ isActiveUrl('/alphabet/i') }}"><a href="/alphabet/i" title="I">I</a></li>

                <li class="{{ isActiveUrl('/alphabet/j') }}"><a href="/alphabet/j" title="J">J</a></li>
                <li class="{{ isActiveUrl('/alphabet/k') }}"><a href="/alphabet/k" title="K">K</a></li>
                <li class="{{ isActiveUrl('/alphabet/l') }}"><a href="/alphabet/l" title="L">L</a></li>
                <li class="{{ isActiveUrl('/alphabet/m') }}"><a href="/alphabet/m" title="M">M</a></li>
                <li class="{{ isActiveUrl('/alphabet/n') }}"><a href="/alphabet/n" title="N">N</a></li>
                <li class="{{ isActiveUrl('/alphabet/o') }}"><a href="/alphabet/o" title="O">O</a></li>
                <li class="{{ isActiveUrl('/alphabet/p') }}"><a href="/alphabet/p" title="P">P</a></li>
                <li class="{{ isActiveUrl('/alphabet/q') }}"><a href="/alphabet/q" title="Q">Q</a></li>
                <li class="{{ isActiveUrl('/alphabet/r') }}"><a href="/alphabet/r" title="R">R</a></li>

                <li class="{{ isActiveUrl('/alphabet/s') }}"><a href="/alphabet/s" title="S">S</a></li>
                <li class="{{ isActiveUrl('/alphabet/t') }}"><a href="/alphabet/t" title="T">T</a></li>
                <li class="{{ isActiveUrl('/alphabet/u') }}"><a href="/alphabet/u" title="U">U</a></li>
                <li class="{{ isActiveUrl('/alphabet/v') }}"><a href="/alphabet/v" title="V">V</a></li>
                <li class="{{ isActiveUrl('/alphabet/w') }}"><a href="/alphabet/w" title="W">W</a></li>
                <li class="{{ isActiveUrl('/alphabet/x') }}"><a href="/alphabet/x" title="X">X</a></li>
                <li class="{{ isActiveUrl('/alphabet/y') }}"><a href="/alphabet/y" title="Y">Y</a></li>
                <li class="{{ isActiveUrl('/alphabet/z') }}"><a href="/alphabet/z" title="Z">Z</a></li>
            </ul>
        </li>
    </ul>

    {!! Block::getMobileBlocks() !!}
</div>