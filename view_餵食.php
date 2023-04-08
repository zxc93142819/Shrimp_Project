<?php
if (!isset($_SESSION)) {
	session_start();
	if (!isset($_SESSION["userid"])||$_SESSION["authority"]>1)
      header("location:home");
};
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>詳細資料 - 餵食</title>
	<!--Head-->
	<?php require_once "head.html"?>
    <!--//Head-->
</head>

<body>
	<!--Header-->
    <?php require_once "header.php" ?>
    <!--//Header-->

	<style>
        @media (min-width: 1024px) {
            div.big_form {
                border: solid 1px black;
                animation: change 0s;
            }

            div.small_form {
                display: none;
            }

            @keyframes change {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }
        }

        @media (max-width: 1023px) {
            div.big_form {
                display: none;
            }

            div.small_form {
                border: solid 1px black;
                animation: change 0s;
            }

            @keyframes change {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }
        }
    </style>

	<div>
        <div class="big_form">
        <section>
			<form id="big_form" method="post" enctype="multipart/form-data">
				<div class="form-inline" style = "width: 100% ; height: 50px">
					<div style = "width: 1%"> </div>
					<div style = "width: 10%"> Index </div>
					<div style = "width: 18%">
						<input id="id" name="id" class="form-control" disabled="disabled">
					</div>

					<div style = "width: 2%"> </div>
					<div style = "width: 10%"> TankID </div>
					<div style = "width: 18%">
						<select id="location" name="location" class="custom-select" disabled="disabled">
							<option value=""></option>
							<option value="M1">M1</option>
							<option value="M2">M2</option>
							<option value="M3">M3</option>
							<option value="M4">M4</option>
						</select>
					</div>

					<div style = "width: 2%"> </div>
					<div style = "width: 10%"> 蝦缸資訊 </div>
					<div style = "width: 18%">
						<select id="select_type" name="tank_type" class="custom-select" disabled="disabled">
							<option value=""></option>
							<option value="公蝦缸">公蝦缸</option>
							<option value="母蝦缸">母蝦缸</option>
							<option value="交配缸">交配缸</option>
							<option value="休養缸">休養缸</option>
						</select>
					</div>
				</div>

				<div class="form-inline" style = "width: 100% ; height: 100px">
					<div style = "width: 1%"> </div>
					<div style = "width: 10%"> 日期 </div>
					<div style = "width: 18%">
						<input id="date" name="date" type="date" disabled="disabled">
					</div>

					<div style = "width: 2%"> </div>
					<div style = "width: 10%"> 時間 </div>
					<div style = "width: 18%">
						<select id="select_time" name="time" class="custom-select" disabled="disabled">
							<option value=""></option>
							<option value="9">9:00</option>
							<option value="11">11:00</option>
							<option value="14">14:00</option>
							<option value="16">16:00</option>
							<option value="19">19:00</option>
							<option value="23">23:00</option>
							<option value="3">03:00</option>
						</select>
					</div>

					<div style = "width: 2%"> </div>
					<div style = "width: 10%"> 工作/餵食項目 </div>
					<div style = "width: 18%">
						<select id="select_work" name="work" class="custom-select" disabled="disabled">
							<option value=""></option>
							<option value="Polychaete">Polychaete</option>
							<option value="Crab(去殼)">Crab(去殼)</option>
							<option value="Squid">Squid</option>
							<option value="Mussel">Mussel</option>
							<option value="Epsilon">Epsilon</option>
							<option value="日本飼料">日本飼料</option>
							<option value="Krill">Krill</option>
							<option value="Clam(母)">Clam(母)</option>
							<option value="Ezmate(海膽+蟹卵)">Ezmate(海膽+蟹卵)</option>
							<option value="Ezmate(海膽+蟹白)">Ezmate(海膽+蟹白)</option>
							<option value="Ezmate(海膽+蟹黃)">Ezmate(海膽+蟹黃)</option>
							<option value="Ezmate(海膽)">Ezmate(海膽)</option>
							<option value="其他">其他</option>
							<!-- 需確認選 "其他" 需填值 -->
						</select>
						<div class="input-group">
							<input id="else_work" name="else_work" placeholder="其他" type="text" class="form-control" readonly value='.$_GET['else_work'].' >
						</div>
					</div>
				</div>

				<div class="form-inline" style = "width: 100% ; height: 50px">
					<div style = "width: 1%"> </div>
					<div style = "width: 10%"> 公蝦數量 </div>
					<input id="male_shrimp" name="male_shrimp" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="male_shrimp" style = "width: auto;">隻</div>

					<div style = "width: 2%"> </div>

					<div style = "width: 10%"> 母蝦數量 </div>
					<input id="female_shrimp" name="female_shrimp" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="female_shrimp" style = "width: auto;">隻</div>
				</div>

				<div class="form-inline" style = "width: 100% ; height: 50px">
					<div style = "width: 1%"> </div>
					<div style = "width: 10%"> 死亡公蝦數量 </div>
					<input id="dead_male_shrimp" name="dead_male_shrimp" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="dead_female_shrimp" style = "width: auto;">隻</div>
				
					<div style = "width: 2%"> </div>

					<div style = "width: 10%"> 死亡母蝦數量 </div>
					<input id="dead_female_shrimp" name="dead_female_shrimp" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="dead_female_shrimp" style = "width: auto;">隻</div>
				</div>

				<div class="form-inline" style = "width: 100% ; height: 50px">
					<div style = "width: 1%"> </div>
					<div style = "width: 10%"> 脫皮公蝦數量 </div>
					<input id="peeling_male_shrimp" name="peeling_male_shrimp" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="peeling_male_shrimp" style = "width: auto;">隻</div>
				
					<div style = "width: 2%"> </div>

					<div style = "width: 10%"> 脫皮母蝦數量 </div>
					<input id="peeling_female_shrimp" name="peeling_female_shrimp" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="peeling_female_shrimp" style = "width: auto;">隻</div>
				</div>

				<div class="form-inline" style = "width: 100% ; height: 50px">
					<div style = "width: 1%"> </div>
					<div style = "width: 10%"> 公蝦均重 </div>
					<input id="avg_male_shrimp" name="avg_male_shrimp" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="avg_male_shrimp" style = "width: auto;">(g)</div>
				
					<div style = "width: 2%"> </div>

					<div style = "width: 10%"> 母蝦均重 </div>
					<input id="avg_female_shrimp" name="avg_female_shrimp" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="avg_female_shrimp" style = "width: auto;">(g)</div>
				
					<div style = "width: 2%"> </div>

					<div style = "width: 10%"> 總重 </div>
					<input id="total_weight" name="total_weight" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="total_weight" style = "width: auto;">(g)</div>
				</div>
				
				<div class="form-inline" style = "width: 100% ; height: 50px">
					<div style = "width: 1%"> </div>
					<div style = "width: 10%"> 餵食量 </div>
					<input id="food_weight" name="food_weight" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="food_weight" style = "width: auto;">(g)</div>

					<div style = "width: 2%"> </div>

					<div style = "width: 10%"> 殘餌量 </div>
					<input id="food_remain" name="food_remain" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="food_remain" style = "width: auto;">(g)</div>
				
					<div style = "width: 2%"> </div>

					<div style = "width: 10%"> 食用量 </div>
					<input id="eating" name="eating" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="eating" style = "width: auto;">(g)</div>
				</div>

				<div class="form-inline" style = "width: 100% ; height: 75px">
					<div style = "width: 1%"> </div>
					<div style = "width: 10%"> Feeding Ratio </div>
					<input id="FeedingRatio" name="FeedingRatio" type="text" class="form-control" style = "width: 15%;" disabled="disabled">
					<div class="input-group-text" for="FeedingRatio" style = "width: auto;">(%)</div>

					<div style = "width: 2%"> </div>
					<div style = "width: 10%"> Observation </div>
					<div style = "width: 40%">
						<textarea id="Observation" name="Observation" cols="40" rows="5"class="form-control" disabled="disabled"></textarea>      
					</div>
				</div>

				<div class="form-inline" style = "width: 100% ; height: 5px">
					<div style = "height: 2%"> </div>
				</div>
						
				<div class="form-inline" style = "width: 100% ; height: 50px">
					<div style = "width: 1%"> </div>
					<button type="button" onclick="back()" class="btn btn-primary">返回查詢</button>
					<div id="backmsg"></div>
				</div>

				<div class="form-inline" style = "width: 100% ; height: 5px">
					<div style = "height: 2%"> </div>
				</div>
			</form>
        </section>
        </div>

        <div class="small_form">
            <section>
				<form id="small_form" method="post" enctype="multipart/form-data">
					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> Index </div>
						<div style = "width: 40%">
							<input id="id" name="id" class="form-control" readonly>
						</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> TankID </div>
						<div style = "width: 40%">
							<select id="location" name="location" class="custom-select" disabled="disabled">
								<option value=""></option>
								<option value="M1">M1</option>
								<option value="M2">M2</option>
								<option value="M3">M3</option>
								<option value="M4">M4</option>
							</select>
						</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 蝦缸資訊 </div>
						<div style = "width: 40%">
							<select id="select_type" name="tank_type" class="custom-select" disabled="disabled">
								<option value=""></option>
								<option value="公蝦缸">公蝦缸</option>
								<option value="母蝦缸">母蝦缸</option>
								<option value="交配缸">交配缸</option>
								<option value="休養缸">休養缸</option>
							</select>
						</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 日期 </div>
						<div style = "width: 40%">
							<input id="date" name="date" type="date" disabled="disabled">
						</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 時間 </div>
						<div style = "width: 40%">
							<select id="select_time" name="time" class="custom-select" disabled="disabled">
								<option value=""></option>
								<option value="9">9:00</option>
								<option value="11">11:00</option>
								<option value="14">14:00</option>
								<option value="16">16:00</option>
								<option value="19">19:00</option>
								<option value="23">23:00</option>
								<option value="3">03:00</option>
							</select>
						</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 100px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 工作/餵食項目 </div>
						<div style = "width: 40%">
							<select id="select_work" name="work" class="custom-select" disabled="disabled">
								<option value=""></option>
								<option value="Polychaete">Polychaete</option>
								<option value="Crab(去殼)">Crab(去殼)</option>
								<option value="Squid">Squid</option>
								<option value="Mussel">Mussel</option>
								<option value="Epsilon">Epsilon</option>
								<option value="日本飼料">日本飼料</option>
								<option value="Krill">Krill</option>
								<option value="Clam(母)">Clam(母)</option>
								<option value="Ezmate(海膽+蟹卵)">Ezmate(海膽+蟹卵)</option>
								<option value="Ezmate(海膽+蟹白)">Ezmate(海膽+蟹白)</option>
								<option value="Ezmate(海膽+蟹黃)">Ezmate(海膽+蟹黃)</option>
								<option value="Ezmate(海膽)">Ezmate(海膽)</option>
								<option value="其他">其他</option>
								<!-- 需確認選 "其他" 需填值 -->
							</select>
							<div class="input-group">
								<input id="else_work" name="else_work" placeholder="其他" type="text" class="form-control" readonly>
							</div>
						</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 公蝦數量 </div>
						<input id="male_shrimp" name="male_shrimp" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="male_shrimp" style = "width: auto;">隻</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 母蝦數量 </div>
						<input id="female_shrimp" name="female_shrimp" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="female_shrimp" style = "width: auto;">隻</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 死亡公蝦數量 </div>
						<input id="dead_male_shrimp" name="dead_male_shrimp" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="dead_female_shrimp" style = "width: auto;">隻</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 死亡母蝦數量 </div>
						<input id="dead_female_shrimp" name="dead_female_shrimp" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="dead_female_shrimp" style = "width: auto;">隻</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 脫皮公蝦數量 </div>
						<input id="peeling_male_shrimp" name="peeling_male_shrimp" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="peeling_male_shrimp" style = "width: auto;">隻</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 脫皮母蝦數量 </div>
						<input id="peeling_female_shrimp" name="peeling_female_shrimp" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="peeling_female_shrimp" style = "width: auto;">隻</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 公蝦均重 </div>
						<input id="avg_male_shrimp" name="avg_male_shrimp" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="avg_male_shrimp" style = "width: auto;">(g)</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 母蝦均重 </div>
						<input id="avg_female_shrimp" name="avg_female_shrimp" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="avg_female_shrimp" style = "width: auto;">(g)</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 總重 </div>
						<input id="total_weight" name="total_weight" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="total_weight" style = "width: auto;">(g)</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 餵食量 </div>
						<input id="food_weight" name="food_weight" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="food_weight" style = "width: auto;">(g)</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 殘餌量 </div>
						<input id="food_remain" name="food_remain" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="food_remain" style = "width: auto;">(g)</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> 食用量 </div>
						<input id="eating" name="eating" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="eating" style = "width: auto;">(g)</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> Feeding Ratio </div>
						<input id="FeedingRatio" name="FeedingRatio" type="text" class="form-control" style = "width: 40%;" disabled="disabled">
						<div class="input-group-text" for="FeedingRatio" style = "width: auto;">(%)</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 75px">
						<div style = "width: 5%"> </div>
						<div style = "width: 30%"> Observation </div>
						<div style = "width: 40%">
							<textarea id="Observation" name="Observation" cols="30" rows="5"class="form-control" disabled="disabled"></textarea>      
						</div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 5px">
						<div style = "height: 2%"> </div>
					</div>
							
					<div class="form-inline" style = "width: 100% ; height: 50px">
						<div style = "width: 5%"> </div>
						<button type="button" onclick="back()" class="btn btn-primary">返回查詢</button>
						<div id="backmsg"></div>
					</div>

					<div class="form-inline" style = "width: 100% ; height: 5px">
						<div style = "height: 2%"> </div>
					</div>
				</form>
            </section>
        </div>
    </div>

	<script>
		document.write('<script type="text/javascript" src="feed_check.js"></'+'script>');

		window.onload = function() {
			//頁面載入後將資料放到form上面
			var urlParams = new URLSearchParams(window.location.search);
			modify_put_into_form(urlParams , "big_form" , 0);
			modify_put_into_form(urlParams , "small_form" , 0);
        }

        function back() {
            window.location.href='find_餵食';
        }
    </script>

	<!--Footer-->
    <?php require_once "footer.html" ?>
    <!--//Footer-->

    <!--Other Script-->
	<?php require_once "other_script.html" ?>
    <!--//Other Script-->
</body>

</html>