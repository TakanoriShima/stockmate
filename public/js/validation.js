/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/validation.js":
/*!************************************!*\
  !*** ./resources/js/validation.js ***!
  \************************************/
/***/ (() => {

eval("// 入力ボックスの要素と文字数表示用の要素を取得\nvar inputBox = document.getElementById('name');\nvar charCount = document.getElementById('count');\nvar maxLength = 50; // 最大文字数を設定\n// 入力が変更された時に文字数を更新\ninputBox.addEventListener('input', function () {\n  var currentLength = inputBox.value.length; // 現在の文字数を取得\n  charCount.textContent = '現在' + currentLength + '文字'; // 文字数を表示\n  if (currentLength > maxLength) {\n    // 最大文字数を超えた場合、入力ボックスを制限\n    inputBox.value = inputBox.value.slice(0, maxLength);\n    charCount.style.color = 'red'; // 文字数表示を赤に変更\n    charCount.textContent = maxLength + '文字を超えました'; // 文字数を表示\n  } else {\n    charCount.style.color = 'black'; // 文字数表示を黒に戻す\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyJpbnB1dEJveCIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJjaGFyQ291bnQiLCJtYXhMZW5ndGgiLCJhZGRFdmVudExpc3RlbmVyIiwiY3VycmVudExlbmd0aCIsInZhbHVlIiwibGVuZ3RoIiwidGV4dENvbnRlbnQiLCJzbGljZSIsInN0eWxlIiwiY29sb3IiXSwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2pzL3ZhbGlkYXRpb24uanM/ZDY2MyJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyDlhaXlipvjg5zjg4Pjgq/jgrnjga7opoHntKDjgajmloflrZfmlbDooajnpLrnlKjjga7opoHntKDjgpLlj5blvpdcbmNvbnN0IGlucHV0Qm94ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ25hbWUnKTtcbmNvbnN0IGNoYXJDb3VudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdjb3VudCcpO1xuY29uc3QgbWF4TGVuZ3RoID0gNTA7IC8vIOacgOWkp+aWh+Wtl+aVsOOCkuioreWumlxuLy8g5YWl5Yqb44GM5aSJ5pu044GV44KM44Gf5pmC44Gr5paH5a2X5pWw44KS5pu05pawXG5pbnB1dEJveC5hZGRFdmVudExpc3RlbmVyKCdpbnB1dCcsIGZ1bmN0aW9uKCkge1xuICAgIGNvbnN0IGN1cnJlbnRMZW5ndGggPSBpbnB1dEJveC52YWx1ZS5sZW5ndGg7IC8vIOePvuWcqOOBruaWh+Wtl+aVsOOCkuWPluW+l1xuICAgIGNoYXJDb3VudC50ZXh0Q29udGVudCA9ICfnj77lnKgnICsgY3VycmVudExlbmd0aCArICfmloflrZcnOyAvLyDmloflrZfmlbDjgpLooajnpLpcbiAgICBpZiAoY3VycmVudExlbmd0aCA+IG1heExlbmd0aCkge1xuICAgICAgICAvLyDmnIDlpKfmloflrZfmlbDjgpLotoXjgYjjgZ/loLTlkIjjgIHlhaXlipvjg5zjg4Pjgq/jgrnjgpLliLbpmZBcbiAgICAgICAgaW5wdXRCb3gudmFsdWUgPSBpbnB1dEJveC52YWx1ZS5zbGljZSgwLCBtYXhMZW5ndGgpO1xuICAgICAgICBjaGFyQ291bnQuc3R5bGUuY29sb3IgPSAncmVkJzsgLy8g5paH5a2X5pWw6KGo56S644KS6LWk44Gr5aSJ5pu0XG4gICAgICAgIGNoYXJDb3VudC50ZXh0Q29udGVudCA9IG1heExlbmd0aCArICfmloflrZfjgpLotoXjgYjjgb7jgZfjgZ8nOyAvLyDmloflrZfmlbDjgpLooajnpLpcbiAgICB9IGVsc2Uge1xuICAgICAgICBjaGFyQ291bnQuc3R5bGUuY29sb3IgPSAnYmxhY2snOyAvLyDmloflrZfmlbDooajnpLrjgpLpu5LjgavmiLvjgZlcbiAgICB9XG59KTsiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0EsSUFBTUEsUUFBUSxHQUFHQyxRQUFRLENBQUNDLGNBQWMsQ0FBQyxNQUFNLENBQUM7QUFDaEQsSUFBTUMsU0FBUyxHQUFHRixRQUFRLENBQUNDLGNBQWMsQ0FBQyxPQUFPLENBQUM7QUFDbEQsSUFBTUUsU0FBUyxHQUFHLEVBQUUsQ0FBQyxDQUFDO0FBQ3RCO0FBQ0FKLFFBQVEsQ0FBQ0ssZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFlBQVc7RUFDMUMsSUFBTUMsYUFBYSxHQUFHTixRQUFRLENBQUNPLEtBQUssQ0FBQ0MsTUFBTSxDQUFDLENBQUM7RUFDN0NMLFNBQVMsQ0FBQ00sV0FBVyxHQUFHLElBQUksR0FBR0gsYUFBYSxHQUFHLElBQUksQ0FBQyxDQUFDO0VBQ3JELElBQUlBLGFBQWEsR0FBR0YsU0FBUyxFQUFFO0lBQzNCO0lBQ0FKLFFBQVEsQ0FBQ08sS0FBSyxHQUFHUCxRQUFRLENBQUNPLEtBQUssQ0FBQ0csS0FBSyxDQUFDLENBQUMsRUFBRU4sU0FBUyxDQUFDO0lBQ25ERCxTQUFTLENBQUNRLEtBQUssQ0FBQ0MsS0FBSyxHQUFHLEtBQUssQ0FBQyxDQUFDO0lBQy9CVCxTQUFTLENBQUNNLFdBQVcsR0FBR0wsU0FBUyxHQUFHLFVBQVUsQ0FBQyxDQUFDO0VBQ3BELENBQUMsTUFBTTtJQUNIRCxTQUFTLENBQUNRLEtBQUssQ0FBQ0MsS0FBSyxHQUFHLE9BQU8sQ0FBQyxDQUFDO0VBQ3JDO0FBQ0osQ0FBQyxDQUFDIiwiaWdub3JlTGlzdCI6W10sImZpbGUiOiIuL3Jlc291cmNlcy9qcy92YWxpZGF0aW9uLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/validation.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/validation.js"]();
/******/ 	
/******/ })()
;