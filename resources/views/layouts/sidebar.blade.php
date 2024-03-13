
<div class="left-side-bar">
		<div class="brand-logo">
			<a href="/Dashboard">
				<img src="{{ asset('images/prismlogo.png') }}" alt="">
			</a>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="/Dashboard" class="dropdown-toggle no-arrow">
							<span class="fa fa-home"></span><span class="mtext">Home </span>
						</a>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-search"></span>Running Sites</span>
						</a>
						 <ul class="submenu">

							 <!-- <li><a href="/Ibr">IBR </a></li>
							<li><a href="/valuation">Valuation </a></li>
							 <li><a href="/Debt">Debt Collection </a></li>-->
							{{-- <li><a href="/inspection">Livestock</a></li>
                            <li><a href="/verification">Address Verification</a></li> --}}
							{{-- <li><a href="/valuation">Valuation </a></li>
							<li><a href="/Muccaduum">Muccaduum</a></li>
                            <li><a href="/verification">Address Verification</a></li>
							 <li><a href="/inspection">Livestock</a></li>
							 <li><a href="/Ibr">IBR </a></li>
							 <li><a href="/ie">Income Estimation</a></li>
							 <li><a href="/lcr">LCR</a></li>
							 <li><a href="/mcr">MCR</a></li>
							 <li><a href="/supervision">Supervision</a></li>
							 <li><a href="/Clearing">Clearing</a></li>
							 <li><a href="/bir">BIR</a></li>
							 <li><a href="/ie">Income Estimation</a></li>
							<li><a href="/mvr">MVR</a></li>  --}}

							<!-- <li><a href="/Muccaduum">Muccaduum</a></li>
							<li><a href="/supervision">Supervision</a></li>
							<li><a href="/Clearing">Clearing</a></li>
							<li><a href="/bir">BIR</a></li>
							<li><a href="/ie">Income Estimation</a></li>
							<li><a href="/lcr">LCR</a></li>
							<li><a href="/mcr">MCR</a></li>
							<li><a href="/mvr">MVR</a></li> -->
							<li><a href="/prism">Prism</a></li>

						</ul>
					</li>
					@if(Auth::user()->role==1 || Auth::user()->role==3)
	
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-money-bill"></span>Billing</span>
						</a>
						 <ul class="submenu">
						 <li><a href="/billing">Make Receipts</a></li>
							<li><a href="/posts">Un-Posted</a></li>
							<li><a href="/allReceipts">Receipts</a></li>
							<li><a href="/bills">Bills</a></li>
							{{-- <li><a href="/verification-invoices">Verification Invoices</a></li> --}}
							<li><a href="/prism-invoices">Prism Invoices</a></li>

						</ul>
					</li>
					<li>
						<a href="/prism-surveys" class="dropdown-toggle no-arrow">
							<span class="fa fa-chart-bar"></span><span class="mtext">Survey Statistics </span>
						</a>
					</li>
					@endif

                    <li>
                        <a href="/statistics" class="dropdown-toggle no-arrow">
                            <span class="fa fa-chart-pie"></span><span class="mtext">Statistics </span>
                        </a>
                    </li>
                      <!--  <li>-->
					<!--	<a href="/users" class="dropdown-toggle no-arrow">-->
					<!--		<span class="fa fa-users"></span><span class="mtext">Users </span>-->
					<!--	</a>-->
					<!--</li>-->
					<!-- <li>
						<a href="/logs" class="dropdown-toggle no-arrow">
							<span class="fa fa-network-wired"></span><span class="mtext">Activity Log </span>
						</a>
					</li>
 -->




					<!-- <li>
						<a href="/geStats" class="dropdown-toggle no-arrow">
							<span class="fa fa-chart-bar"></span><span class="mtext">Statistics </span>
						</a>
					</li>
					<li>
						<a href="/users" class="dropdown-toggle no-arrow">
							<span class="fa fa-user"></span><span class="mtext">User's Manager </span>
						</a>
					</li> -->

					<!-- <li cla
					ss="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-table"></span><span class="mtext">Tables</span>
						</a>
						<ul class="submenu">
							<li><a href="/basicTable">Basic Tables</a></li>
							<li><a href="/dataTable">DataTables</a></li>
						</ul>
					</li>
					<li>
						<a href="/calender" class="dropdown-toggle no-arrow">
							<span class="fa fa-calendar-o"></span><span class="mtext">Calendar</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-desktop"></span><span class="mtext"> UI Elements </span>
						</a>
						<ul class="submenu">
							<li><a href="/uiButtons">Buttons</a></li>
							<li><a href="/uiCards">Cards</a></li>
							<li><a href="/uiCardsHover">Cards Hover</a></li>
							<li><a href="/uiModals">Modals</a></li>
							<li><a href="/uiTabs">Tabs</a></li>
							<li><a href="/uiToolTipPop">Tooltip &amp; Popover</a></li>
							<li><a href="/uiSweet">Sweet Alert</a></li>
							<li><a href="/uiNotification">Notification</a></li>
							<li><a href="/uiTimeline">Timeline</a></li>
							<li><a href="/uiProgress">Progressbar</a></li>
							<li><a href="/uiTypo">Typography</a></li>
							<li><a href="/uiList">List group</a></li>
							<li><a href="/uiRange">Range slider</a></li>
							<li><a href="/uiCarousel">Carousel</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-paint-brush"></span><span class="mtext">Icons</span>
						</a>
						<ul class="submenu">
							<li><a href="fontAwsome">FontAwesome Icons</a></li>
							<li><a href="foundation">Foundation Icons</a></li>
							<li><a href="ionicons">Ionicons Icons</a></li>
							<li><a href="themify">Themify Icons</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-plug"></span><span class="mtext">Additional Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="/videoPlayer">Video Player</a></li>
							<li><a href="/login">Login</a></li>
							<li><a href="/forget">Forgot Password</a></li>
							<li><a href="/reset">Reset Password</a></li>
							<li><a href="/error1">403</a></li>
							<li><a href="/error2">404</a></li>
							<li><a href="/error3">500</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-pie-chart"></span><span class="mtext">Charts</span>
						</a>
						<ul class="submenu">
							<li><a href="/highChart">Highchart</a></li>
							<li><a href="/knobChart">jQuery Knob</a></li>
							<li><a href="/jvectorMap">jvectormap</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-clone"></span><span class="mtext">Extra Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="/blank">Blank</a></li>
							<li><a href="/contactDirectory">Contact Directory</a></li>
							<li><a href="/blog">Blog</a></li>
							<li><a href="/blogDetails">Blog Detail</a></li>
							<li><a href="/product">Product</a></li>
							<li><a href="/productDetail">Product Detail</a></li>
							<li><a href="/faq">FAQ</a></li>
							<li><a href="/profile">Profile</a></li>
							<li><a href="/gallery">Gallery</a></li>
							<li><a href="/pricingTable">Pricing Tables</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-list"></span><span class="mtext">Multi Level Menu</span>
						</a>
						<ul class="submenu">
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li class="dropdown">
								<a href="javascript:;" class="dropdown-toggle">
									<span class="fa fa-plug"></span><span class="mtext">Level 2</span>
								</a>
								<ul class="submenu child">
									<li><a href="javascript:;">Level 2</a></li>
									<li><a href="javascript:;">Level 2</a></li>
								</ul>
							</li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
						</ul>
					</li>
					<li>
						<a href="/siteMap" class="dropdown-toggle no-arrow">
							<span class="fa fa-sitemap"></span><span class="mtext">Sitemap</span>
						</a>
					</li>
					<li>
						<a href="/chat" class="dropdown-toggle no-arrow">
							<span class="fa fa-comments-o"></span><span class="mtext">Chat <span class="fi-burst-new text-danger new"></span></span>
						</a>
					</li>
					<li>
						<a href="/invoice" class="dropdown-toggle no-arrow">
							<span class="fa fa-map-o"></span><span class="mtext">Invoice</span>
						</a>
					</li> -->
				</ul>
			</div>
		</div>
	</div>
