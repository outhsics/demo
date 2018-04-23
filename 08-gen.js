const time_measture = require('./measure')

// 生成数字，随机打乱，输出
function gen(w){
  const arr = []
  for(let i = 0; i < w * 10000; i++){
    arr[i] = i+1
  }

  fisher_yates_shuffle(arr)

  return arr
}

// [1,2,3,4]
// [1] -> [4,2,3,1]
// [4, 2] -> [4,2,3,1]
// [4, 2, 1]

// O(nlgn) O(n!)
// O(n)的打乱算法
function fisher_yates_shuffle(arr){
  for(let i = 0; i < arr.length - 1; i++){ // 2N + 2
    // 从 [i, arr.length - 1] 中取一个整数
    // [i, N)
    const j = i + Math.floor( Math.random() * (arr.length - i));

    // c1 * N

    // c2 * N
    [ arr[i], arr[j] ] = [ arr[j], arr[i] ]
  }

  // 2N + 2 + (c1+c2) * N = (c1+c2+2)*N + C3
  return arr
}


// 错误的shuffle方法
function shuffle_simple(arr){
  return arr.sort((x,y) => Math.random() - .5)
}


const arr = gen(100)
for(let i = 0; i < arr.length; i++){
  console.log(arr[i])
}