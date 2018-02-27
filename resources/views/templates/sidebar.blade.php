<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">     
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>        
        

        @if(Route::getRoutes()->hasNamedRoute('clientes.index'))
          @permissao('clientes')
            <li>
              <a href="{{ route('clientes.index')}}">
                <i class="fa fa-users fa-lg fa-2x text-green"></i> <span> CLIENTES </span>
              </a>
            </li>
          @endpermissao
        @endif 


        @if(Route::getRoutes()->hasNamedRoute('atendimentos.index'))
          @permissao('atendimentos')
            <li>
              <a href="{{ route('atendimentos.index')}}">
                <i class="glyphicon glyphicon-list-alt fa-lg fa-2x text-orange"></i> <span>RELATÓRIO DE CAIXA</span>
              </a>
            </li>
          @endpermissao
        @endif
          



        @if(Route::getRoutes()->hasNamedRoute('servicos.index'))
         <li class="treeview">
          <a href="#"><i class="fa fa-check-circle  fa-lg fa-2x text-primary"></i> <span>CADASTRO</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              @if(Route::getRoutes()->hasNamedRoute('servicos.index'))
                @permissao('servicos')
                    <li class="nav-item">
                      <a class="nav-link active" href="{{ route('servicos.index')}}">
                        <i class="glyphicon glyphicon-scissors fa-lg text-primary" aria-hidden="true"></i>
                        Serviços
                      </a>
                    </li>
                @endpermissao			
              @endif
              @if(Route::getRoutes()->hasNamedRoute('produtos.index'))    
                @permissao('produtos')
                    <li class="nav-item">
                      <a class="nav-link active" href="{{ route('produtos.index')}}">
                        <i class="fa fa-gift  fa-lg text-primary" aria-hidden="true"></i>
                        Produtos
                      </a>
                    </li>
                @endpermissao	
              @endif
              @if(Route::getRoutes()->hasNamedRoute('operadoras.index'))
                @permissao('operadoras')
                    <li class="nav-item">
                      <a class="nav-link active" href="{{ route('operadoras.index')}}">
                        <i class="fa fa-credit-card-alt  fa-lg text-primary" aria-hidden="true"></i>
                        Operadoras
                      </a>
                    </li>
                @endpermissao	
              @endif
          </ul>
        </li>
      @endif



      @if(Route::getRoutes()->hasNamedRoute('despesas.index'))
       @permissao('despesas')            
          <li>                
            <a href="{{ route('despesas.index')}}"><i class="fa fa-money text-red fa-lg fa-2x"></i> <span>DESPESAS</span></a>
          </li>
        @endpermissao
      @endif
      @if(Route::getRoutes()->hasNamedRoute('funcionarios.index'))
        @permissao('funcionarios')
          <li>
            <a href="{{ route('funcionarios.index')}}"><i class="fa fa-users fa-lg fa-2x text-purple"></i> <span>FUNCIONÁRIOS</span></a>
          </li>
        @endpermissao
      @endif





      @if(Route::getRoutes()->hasNamedRoute('gerencialAtendimentos.index'))
        @permissao('gerencial') 
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-globe fa-lg fa-2x text-blue"></i> <span>GERENCIAL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           @if(Route::getRoutes()->hasNamedRoute('gerencialAtendimentos.index'))
            
              <li class="active">
                <a  href="{{ route('gerencialAtendimentos.index') }}"> <span class="sr-only">(current)</span>
                  <i class="glyphicon glyphicon-earphone fa-lg text-blue" aria-hidden="true"></i>
                  Atendimentos
                </a>
              </li>



               <li class="active">
                <a  href="{{ route('pagamentos.index') }}"> <span class="sr-only">(current)</span>
                  <i class="glyphicon glyphicon-earphone fa-lg text-blue" aria-hidden="true"></i>
                  Pagamentos
                </a>
              </li>
           
           @endif
          @if(Route::getRoutes()->hasNamedRoute('gerencial.relatorio.geral'))
           
              <li class="active">
                <a  href="{{ route('gerencial.relatorio.geral') }}" target="_blank"> <span class="sr-only">(current)</span>
                  <i class="fa fa-line-chart  fa-lg text-blue" aria-hidden="true"></i>
                  Relatorio Geral
                </a>
              </li>

               <li class="active">
                <a  href="{{ route('gerencial.relatorio.index') }}" > <span class="sr-only">(current)</span>
                  <i class="fa fa-line-chart  fa-lg text-blue" aria-hidden="true"></i>
                  Relatorio 
                </a>
              </li>
           
           @endif
            
          </ul>
        </li>
         @endpermissao
      @endif










        @if(Route::getRoutes()->hasNamedRoute('autorizacao')) 
        @permissao('admin-master-power')

            <li class="treeview">
              <a href="#">
                  <i class="glyphicon glyphicon-wrench fa-lg fa-2x text-red"></i> <span>ADMIN</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">

                @if(Route::getRoutes()->hasNamedRoute('autorizacao_users.index'))
                  @permissao('usuarios')
                    <li class="active">
                      <a  href="{{ route('autorizacao_users.index') }}"> <span class="sr-only">(current)</span>
                        <i class="fa fa-id-card" aria-hidden="true"></i>
                        Usuários
                      </a>
                    </li>
                  @endpermissao
                @endif


                @if(Route::getRoutes()->hasNamedRoute('perfis.index'))
                  @permissao('usuarios')
                    <li class="active">
                      <a  href="{{ route('perfis.index') }}"> <span class="sr-only">(current)</span>
                        <i class="fa fa-id-card" aria-hidden="true"></i>
                        Perfil
                      </a>
                    </li>
                  @endpermissao 
                @endif



                @if(Route::getRoutes()->hasNamedRoute('permissoes.index'))
                  @permissao('usuarios')
                    <li class="active">
                      <a  href="{{ route('permissoes.index') }}"> <span class="sr-only">(current)</span>
                        <i class="fa fa-id-card" aria-hidden="true"></i>
                        Permissões
                      </a>
                    </li>
                  @endpermissao
                @endif

              </ul>
            </li>

          @endpermissao
        @endif
         






        @if(Route::getRoutes()->hasNamedRoute('calendar'))
          @permissao('calendar')
            <li>
              <a href="{{ route('calendar')}}"><i class="fa fa-calendar fa-lg fa-2x text-purple"></i> <span>calendar</span></a>
            </li>
          @endpermissao
        @endif










        @if(Route::getRoutes()->hasNamedRoute('servicosAjax.index'))
        @permissao('super-admin')
        <li class="treeview">
         <a href="#"><i class="fa fa-check-circle  fa-lg fa-2x text-primary"></i> <span>CADASTRO</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
             @if(Route::getRoutes()->hasNamedRoute('servicosAjax.index'))
               @permissao('servicos')
                   <li class="nav-item">
                     <a class="nav-link active" href="{{ route('servicosAjax.index')}}">
                       <i class="glyphicon glyphicon-scissors fa-lg text-primary" aria-hidden="true"></i>
                       Serviços
                     </a>
                   </li>
               @endpermissao			
             @endif
             @if(Route::getRoutes()->hasNamedRoute('produtosAjax.index'))    
               @permissao('produtos')
                   <li class="nav-item">
                     <a class="nav-link active" href="{{ route('produtosAjax.index')}}">
                       <i class="fa fa-gift  fa-lg text-primary" aria-hidden="true"></i>
                       Produtos
                     </a>
                   </li>
               @endpermissao	
             @endif
             @if(Route::getRoutes()->hasNamedRoute('operadorasAjax.index'))
               @permissao('operadoras')
                   <li class="nav-item">
                     <a class="nav-link active" href="{{ route('operadorasAjax.index')}}">
                       <i class="fa fa-credit-card-alt  fa-lg text-primary" aria-hidden="true"></i>
                       Operadoras
                     </a>
                   </li>
               @endpermissao	
             @endif
         </ul>
       </li>
       @endpermissao
     @endif




        <li class="header">LABELS</li>







        @if(Route::getRoutes()->hasNamedRoute('apagadosOperadorasAjax.index'))
        @permissao('super-admin')
        <li class="treeview">
         <a href="#"><i class="fa fa-check-circle  fa-lg fa-2x text-red"></i> <span>CADASTRO Apagados</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
                
             @if(Route::getRoutes()->hasNamedRoute('apagadosOperadorasAjax.index'))
               @permissao('operadoras')
                   <li class="nav-item">
                     <a class="nav-link active" href="{{ route('apagadosOperadorasAjax.index')}}">
                       <i class="fa fa-credit-card-alt  fa-lg text-primary" aria-hidden="true"></i>
                       Operadoras
                     </a>
                   </li>
               @endpermissao	
             @endif
         </ul>
       </li>
       @endpermissao
     @endif

    
        @yield('menuLateral')
               
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
